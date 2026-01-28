<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect('/backend/admin');
            }
            if ($role === 'petugas_gizi') {
                return redirect('/backend/gizi');
            }
            if ($role === 'petugas_pengaduan') {
                return redirect('/backend/pengaduan');
            }

            return redirect('/login');
        }

        return back()->withErrors([
            'username'=>'Login gagal',
        ]);
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
