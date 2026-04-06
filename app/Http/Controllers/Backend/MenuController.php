<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Contracts\View\View;

class MenuController extends Controller
{
    /**
     * Display a listing of all menus.
     */
    public function index(): View
    {
        $menus = Menu::with(['school', 'nutrition'])
            ->latest('tanggal_menu')
            ->paginate(15);

        return view('backend.admin.menus.index', [
            'menus' => $menus,
        ]);
    }

    /**
     * Display menu history/details.
     */
    public function history(): View
    {
        $menus = Menu::with(['school', 'nutrition'])
            ->latest('tanggal_menu')
            ->get();

        return view('backend.admin.menus.history', [
            'menus' => $menus,
        ]);
    }

    /**
     * Show a single menu detail.
     */
    public function show(Menu $menu): View
    {
        $menu->load(['school', 'nutrition']);

        return view('backend.admin.menus.show', [
            'menu' => $menu,
        ]);
    }
}
