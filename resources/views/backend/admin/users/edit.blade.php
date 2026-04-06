@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Edit User</h1>
        <p class="text-sm text-slate-600">Perbarui informasi akun pengguna</p>
    </div>

    <div class="mx-auto max-w-lg">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-5 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                <input type="text" name="username" value="{{ $user->username }}" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="Masukkan username" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Password <span class="font-normal text-slate-500">(kosongkan jika tidak diubah)</span></label>
                <input type="password" name="password" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="Masukkan password baru">
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Role</label>
                <select name="role" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" required>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas_gizi" {{ $user->role === 'petugas_gizi' ? 'selected' : '' }}>Petugas Gizi</option>
                    <option value="petugas_pengaduan" {{ $user->role === 'petugas_pengaduan' ? 'selected' : '' }}>Petugas Pengaduan</option>
                </select>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                    Update
                </button>

                <a href="{{ route('admin.users.index') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

