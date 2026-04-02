<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Complaint;
use App\Models\School;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(): View
    {
        $menusToday = Menu::with(['school', 'nutrition'])
            ->whereDate('tanggal_menu', today())
            ->latest('tanggal_menu')
            ->get();

        return view('frontend.index', [
            'menusToday' => $menusToday,
        ]);
    }

    public function menuDetail(Menu $menu): View
    {
        $menu->load(['school', 'nutrition']);

        return view('frontend.menu-detail', [
            'menu' => $menu,
        ]);
    }

    public function riwayatMenu(): View
    {
        $menus = Menu::with('school')
            ->latest('tanggal_menu')
            ->get();

        $schools = School::query()
            ->orderBy('nama_sekolah')
            ->get();

        return view('frontend.riwayat-menu', [
            'menus' => $menus,
            'schools' => $schools,
        ]);
    }

    public function tim(): View
    {
        $teams = Team::query()->latest()->get();

        return view('frontend.tim', [
            'teams' => $teams,
        ]);
    }

    public function pengaduan(): View
    {
        return view('frontend.pengaduan');
    }

    public function storePengaduan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori' => ['required', 'in:kualitas-makanan,kebersihan,distribusi,lainnya'],
            'deskripsi' => ['required', 'string'],
            'is_anonim' => ['nullable', 'boolean'],
            'nama_pelapor' => ['nullable', 'string', 'required_unless:is_anonim,1'],
            'kontak_pelapor' => ['nullable', 'string', 'required_unless:is_anonim,1'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $isAnonim = $request->boolean('is_anonim');

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('complaints', 'public');
        }

        do {
            $ticketNumber = 'SPPG-' . now()->format('ymdHis') . '-' . random_int(100, 999);
        } while (Complaint::query()->where('ticket_number', $ticketNumber)->exists());

        Complaint::query()->create([
            'ticket_number' => $ticketNumber,
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'],
            'nama_pelapor' => $isAnonim ? null : ($validated['nama_pelapor'] ?? null),
            'kontak_pelapor' => $isAnonim ? null : ($validated['kontak_pelapor'] ?? null),
            'foto' => $fotoPath,
            'status' => 'terkirim',
        ]);

        return redirect()
            ->route('frontend.pengaduan')
            ->with('ticket_number', $ticketNumber)
            ->with('success', 'Pengaduan berhasil dikirim.');
    }
}
