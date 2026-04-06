@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Tambah Sekolah</h1>
        <p class="text-sm text-slate-600">Tambahkan sekolah baru penerima dana MBG</p>
    </div>

    <div class="mx-auto max-w-lg">
        <form action="{{ route('admin.schools.store') }}" method="POST" class="space-y-5 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Sekolah</label>
                <input type="text" name="nama_sekolah" value="{{ old('nama_sekolah') }}" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="Contoh: SDN Kokrosono 01" required>
                @error('nama_sekolah')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Alamat</label>
                <textarea name="alamat" rows="3" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="Masukkan alamat lengkap sekolah" required>{{ old('alamat') }}</textarea>
                @error('alamat')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                    Simpan
                </button>

                <a href="{{ route('admin.schools.index') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
