<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\School;
use App\Models\Team;
use Illuminate\Contracts\View\View;

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
}
