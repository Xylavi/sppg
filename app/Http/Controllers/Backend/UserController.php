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

    public function edit($id){
        $user = \App\Models\User::findOrFail($id);
        return view('backend.admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $user = \App\Models\User::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'role' => 'required',
        ]);

        $data = [
            'username' => $request->username,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index');
    }

    public function destroy($id){
        $user = \App\Models\User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index');
    }

}
