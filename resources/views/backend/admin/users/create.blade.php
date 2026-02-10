@extends('layouts.backend')

@section('content')
<div class="max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Tambah User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1">Username</label>
            <input type="text" name="username" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block mb-1">Password</label>
            <input type="password" name="password" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block mb-1">Role</label>
            <select name="role" class="w-full border p-2 rounded" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="petugas_gizi">Petugas Gizi</option>
                <option value="petugas_pengaduan">Petugas Pengaduan</option>
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Simpan
            </button>

            <a href="{{ route('admin.users.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection

