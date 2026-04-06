@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Tambah User</h1>
        <p class="text-sm text-slate-600">Buat akun pengguna baru untuk sistem SPPG</p>
    </div>

    <div class="mx-auto max-w-lg">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                <input type="text" name="username" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="Masukkan username" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                <input type="password" name="password" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="Masukkan password" required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Role</label>
                <select name="role" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="petugas_gizi">Petugas Gizi</option>
                    <option value="petugas_pengaduan">Petugas Pengaduan</option>
                </select>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                    Simpan
                </button>

                <a href="{{ route('admin.users.index') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

