<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('backend.admin.users.index', compact('users'));
    }

    public function create(){
        return view('backend.admin.users.create');
    }

    public function store(Request $request){
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'role' => 'required',
        ]);

        \App\Models\User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users.index');
    }
}
