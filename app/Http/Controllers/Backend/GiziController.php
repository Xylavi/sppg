<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Nutrition;

class GiziController extends Controller
{
    public function index(){
        $menus = Menu::all();
        return view('backend.gizi.index', compact('menus'));
    }

    public function dashboard()
    {
        return view('backend.gizi.dashboard');
    }

    public function create()
    {
        return view('backend.gizi.create');
    }

    public function store(Request $request)
    {
        $foto_menu = null;
        if ($request->hasFile('foto_menu')) {
            $foto_menu = $request->file('foto_menu')->store('menus', 'public');
        }

        $menu = Menu::create([
            'nama_menu' => $request->nama_menu,
            'tanggal_menu' => $request->tanggal_menu,
            'school_id' => $request->school_id,
            'foto_menu' => $foto_menu,
        ]);

        Nutrition::create([
            'menu_id' => $menu->id,
            'energi' => $request->energi,
            'protein' => $request->protein,
            'lemak' => $request->lemak,
            'karbohidrat' => $request->karbohidrat,
        ]);

        return redirect()->route('gizi.menus.index')->with('success', 'Menu berhasil ditambahkan');
    }
}
