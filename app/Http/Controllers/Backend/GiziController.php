<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\School;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GiziController extends Controller
{
    /**
     * Display the gizi dashboard.
     */
    public function dashboard(): View
    {
        $today = now()->toDateString();
        $todayMenu = Menu::with('school', 'nutrition')
            ->whereDate('tanggal_menu', $today)
            ->first();

        return view('backend.gizi.dashboard', [
            'todayMenu' => $todayMenu,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('backend.gizi');
    }

    /**
     * Show the form for creating a new menu.
     */
    public function create(): View
    {
        $schools = School::all();
        $today = now()->format('Y-m-d');

        return view('backend.gizi.menus.create', [
            'schools' => $schools,
            'today' => $today,
        ]);
    }

    /**
     * Store a newly created menu.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_menu' => ['required', 'string', 'max:255'],
            'tanggal_menu' => ['required', 'date'],
            'school_id' => ['required', 'exists:schools,id'],
            'foto_menu' => ['nullable', 'image', 'max:2048'],
            'energi' => ['required', 'numeric', 'min:0'],
            'protein' => ['required', 'numeric', 'min:0'],
            'lemak' => ['required', 'numeric', 'min:0'],
            'karbohidrat' => ['required', 'numeric', 'min:0'],
        ]);

        // Handle foto upload
        if ($request->hasFile('foto_menu')) {
            $validated['foto_menu'] = $request->file('foto_menu')->store('menus', 'public');
        }

        // Create menu
        $menu = Menu::create($validated);

        // Create nutrition data
        $menu->nutrition()->create([
            'energi' => $validated['energi'],
            'protein' => $validated['protein'],
            'lemak' => $validated['lemak'],
            'karbohidrat' => $validated['karbohidrat'],
        ]);

        return redirect()
            ->route('gizi.dashboard')
            ->with('success', 'Menu berhasil ditambahkan.');
    }

    /**
     * Show the form for editing a menu.
     */
    public function edit(Menu $menu): View
    {
        $schools = School::all();
        $menu->load('nutrition');

        return view('backend.gizi.menus.edit', [
            'menu' => $menu,
            'schools' => $schools,
        ]);
    }

    /**
     * Update the menu.
     */
    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $validated = $request->validate([
            'nama_menu' => ['required', 'string', 'max:255'],
            'tanggal_menu' => ['required', 'date'],
            'school_id' => ['required', 'exists:schools,id'],
            'foto_menu' => ['nullable', 'image', 'max:2048'],
            'energi' => ['required', 'numeric', 'min:0'],
            'protein' => ['required', 'numeric', 'min:0'],
            'lemak' => ['required', 'numeric', 'min:0'],
            'karbohidrat' => ['required', 'numeric', 'min:0'],
        ]);

        // Handle foto upload
        if ($request->hasFile('foto_menu')) {
            $validated['foto_menu'] = $request->file('foto_menu')->store('menus', 'public');
        } else {
            unset($validated['foto_menu']);
        }

        // Update menu
        $menu->update($validated);

        // Update or create nutrition data
        $menu->nutrition()->updateOrCreate(
            ['menu_id' => $menu->id],
            [
                'energi' => $validated['energi'],
                'protein' => $validated['protein'],
                'lemak' => $validated['lemak'],
                'karbohidrat' => $validated['karbohidrat'],
            ]
        );

        return redirect()
            ->route('gizi.dashboard')
            ->with('success', 'Menu berhasil diperbarui.');
    }
}

