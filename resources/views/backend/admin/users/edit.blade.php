@extends('layouts.backend')

@section('content')
<div class="max-w-lg">
    <h1 class="text-2xl font-bold mb-4">Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Username</label>
            <input type="text" name="username" value="{{ $user->username }}" class="w-full border p-2 rounded" required>
        </div>

        <div>
            <label class="block mb-1">Password (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Role</label>
            <select name="role" class="w-full border p-2 rounded" required>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="petugas_gizi" {{ $user->role === 'petugas_gizi' ? 'selected' : '' }}>Petugas Gizi</option>
                <option value="petugas_pengaduan" {{ $user->role === 'petugas_pengaduan' ? 'selected' : '' }}>Petugas Pengaduan</option>
            </select>
        </div>

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                Update
            </button>

            <a href="{{ route('admin.users.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection

