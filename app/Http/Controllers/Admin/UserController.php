<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = \App\Models\User::all();
        return view('backend.admin.index', compact('users'));
    }

    public function create(){
        return 'Tambah User';
    }

    public function store(Request $request){
        return 'Simpan User';
    }

    public function edit($id){
        return 'Edit User' . $id;
    }

    public function update(Request $request, $id){
        return 'Update User' . $id;
    }

    public function destroy($id){
        return 'Hapus User' . $id;
    }

}
