<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Menu;
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

    public function kontakLokasi(): View
    {
        return view('frontend.kontak-lokasi');
    }

    public function submitPengaduan(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori' => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'is_anonim' => ['nullable', 'boolean'],
            'nama_pelapor' => ['nullable', 'string', 'max:255'],
            'kontak_pelapor' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $isAnonim = (bool) ($validated['is_anonim'] ?? false);

        if (! $isAnonim && (empty($validated['nama_pelapor']) || empty($validated['kontak_pelapor']))) {
            return back()
                ->withInput()
                ->withErrors([
                    'identitas' => 'Nama dan kontak pelapor wajib diisi jika tidak anonim.',
                ]);
        }

        $ticketNumber = $this->generateTicketNumber();

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('complaints', 'public');
        }

        Complaint::create([
            'ticket_number' => $ticketNumber,
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'],
            'nama_pelapor' => $isAnonim ? null : $validated['nama_pelapor'],
            'kontak_pelapor' => $isAnonim ? null : $validated['kontak_pelapor'],
            'foto' => $fotoPath,
            'status' => 'terkirim',
        ]);

        return redirect()
            ->route('frontend.pengaduan')
            ->with('success_ticket', $ticketNumber);
    }



    public function cekTiket(Request $request): View
    {
        $validated = $request->validate([
            'ticket' => ['nullable', 'string', 'max:30'],
        ]);

        $ticket = strtoupper(trim($validated['ticket'] ?? ''));

        $complaint = null;
        if ($ticket !== '') {
            $complaint = Complaint::query()
                ->where('ticket_number', $ticket)
                ->first(['ticket_number', 'kategori', 'deskripsi', 'status', 'catatan_tindak_lanjut', 'created_at', 'updated_at']);
        }

        return view('frontend.cek-tiket', [
            'ticket' => $ticket,
            'complaint' => $complaint,
            'hasQuery' => $ticket !== '',
        ]);
    }

    public function aduanPublik(): View
    {
        $complaints = Complaint::query()
            ->latest()
            ->get(['ticket_number', 'kategori', 'deskripsi', 'status', 'created_at']);

        return view('frontend.aduan-publik', [
            'complaints' => $complaints,
        ]);
    }

    private function generateTicketNumber(): string
    {
        do {
            $ticket = 'SPPG-' . now()->format('Ymd') . '-' . str_pad((string) random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        } while (Complaint::query()->where('ticket_number', $ticket)->exists());

        return $ticket;
    }
}
