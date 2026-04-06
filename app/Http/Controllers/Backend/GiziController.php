<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\School;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

        // Fetch recent menus (paginated)
        $recentMenus = Menu::with('school', 'nutrition')
            ->latest('tanggal_menu')
            ->paginate(10);

        // Get total menu count
        $totalMenus = Menu::count();

        return view('backend.gizi.dashboard', [
            'todayMenu' => $todayMenu,
            'recentMenus' => $recentMenus,
            'totalMenus' => $totalMenus,
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
            'porsi' => ['required', 'integer', 'min:1'],
            'energi' => ['required', 'numeric', 'min:0'],
            'protein' => ['required', 'numeric', 'min:0'],
            'lemak' => ['required', 'numeric', 'min:0'],
            'karbohidrat' => ['required', 'numeric', 'min:0'],
        ]);

        // Handle foto upload
        if ($request->hasFile('foto_menu')) {
            $validated['foto_menu'] = $request->file('foto_menu')->store('menus', 'public');
        }

        // Ensure foto_menu key exists so DB NOT NULL column receives a value
        if (! array_key_exists('foto_menu', $validated)) {
            $validated['foto_menu'] = '';
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
            'porsi' => ['required', 'integer', 'min:1'],
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

    /**
     * Display menu history.
     */
    public function history(Request $request): View
    {
        $month = $request->string('bulan')->toString();
        $school = $request->string('sekolah')->toString();

        $query = Menu::with('school', 'nutrition')
            ->where('tanggal_menu', '<=', now()->toDateString());

        if ($month !== '') {
            $query->whereYear('tanggal_menu', explode('-', $month)[0])
                ->whereMonth('tanggal_menu', explode('-', $month)[1]);
        }

        if ($school !== '') {
            $query->where('school_id', $school);
        }

        $menus = $query->latest('tanggal_menu')
            ->paginate(15)
            ->withQueryString();

        $schools = School::all();
        $months = Menu::selectRaw('DATE_FORMAT(tanggal_menu, "%Y-%m") as month')
            ->where('tanggal_menu', '<', now()->toDateString())
            ->distinct()
            ->orderByDesc('month')
            ->pluck('month');

        return view('backend.gizi.menus.history', [
            'menus' => $menus,
            'schools' => $schools,
            'months' => $months,
            'selectedMonth' => $month,
            'selectedSchool' => $school,
        ]);
    }

    /**
     * Show menu detail.
     */
    public function show(Menu $menu): View
    {
        $menu->load('school', 'nutrition');

        return view('backend.gizi.menus.show', [
            'menu' => $menu,
        ]);
    }

    /**
     * Display porsi recap per school.
     */
    public function porsiRecap(): View
    {
        // Get porsi recap per school
        $porsiRecap = Menu::with('school')
            ->selectRaw('school_id, SUM(porsi) as total_porsi, COUNT(*) as menu_count')
            ->groupBy('school_id')
            ->get()
            ->map(function ($item) {
                return [
                    'school_id' => $item->school_id,
                    'school_name' => $item->school->nama_sekolah,
                    'total_porsi' => $item->total_porsi,
                    'menu_count' => $item->menu_count,
                ];
            });

        // Get total porsi across all schools
        $totalPorsi = $porsiRecap->sum('total_porsi');
        $totalMenus = $porsiRecap->sum('menu_count');

        return view('backend.gizi.porsi-recap', [
            'porsiRecap' => $porsiRecap,
            'totalPorsi' => $totalPorsi,
            'totalMenus' => $totalMenus,
        ]);
    }
}

