@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="mb-2 text-3xl font-bold text-slate-900">Detail Menu</h1>
                <p class="text-sm text-slate-600">{{ $menu->tanggal_menu->format('d F Y') }}</p>
            </div>
            <a href="{{ route('admin.menus.index') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Kembali
            </a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Main Info -->
        <div class="lg:col-span-2">
            <div class="rounded-lg border border-slate-200 bg-white shadow-sm p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-6">Informasi Menu</h2>

                <div class="space-y-6">
                    <div>
                        <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide">Nama Menu</label>
                        <p class="mt-2 text-lg font-medium text-slate-900">{{ $menu->nama_menu }}</p>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide">Tanggal Menu</label>
                        <p class="mt-2 text-lg font-medium text-slate-900">{{ $menu->tanggal_menu->format('d F Y') }}</p>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide">Sekolah Penerima</label>
                        <p class="mt-2 text-lg font-medium text-slate-900">{{ $menu->school->nama_sekolah ?? '-' }}</p>
                        @if ($menu->school)
                        <p class="mt-1 text-sm text-slate-600">{{ $menu->school->alamat }}</p>
                        @endif
                    </div>

                    @if ($menu->foto_menu)
                    <div>
                        <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide">Foto Menu</label>
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $menu->foto_menu) }}" alt="{{ $menu->nama_menu }}" class="h-64 w-full rounded-lg object-cover border border-slate-200">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Nutrition Info -->
        <div>
            <div class="rounded-lg border border-slate-200 bg-white shadow-sm p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-6">Data Gizi</h2>

                @if ($menu->nutrition)
                <div class="space-y-4">
                    <div class="rounded-lg bg-blue-50 p-4">
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-1">Energi</p>
                        <p class="text-2xl font-bold text-blue-900">{{ $menu->nutrition->energi ?? '-' }}</p>
                        <p class="text-xs text-blue-700 mt-1">kkal</p>
                    </div>

                    <div class="rounded-lg bg-green-50 p-4">
                        <p class="text-xs font-semibold text-green-600 uppercase tracking-wide mb-1">Protein</p>
                        <p class="text-2xl font-bold text-green-900">{{ $menu->nutrition->protein ?? '-' }}</p>
                        <p class="text-xs text-green-700 mt-1">gram</p>
                    </div>

                    <div class="rounded-lg bg-yellow-50 p-4">
                        <p class="text-xs font-semibold text-yellow-600 uppercase tracking-wide mb-1">Lemak</p>
                        <p class="text-2xl font-bold text-yellow-900">{{ $menu->nutrition->lemak ?? '-' }}</p>
                        <p class="text-xs text-yellow-700 mt-1">gram</p>
                    </div>

                    <div class="rounded-lg bg-orange-50 p-4">
                        <p class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Karbohidrat</p>
                        <p class="text-2xl font-bold text-orange-900">{{ $menu->nutrition->karbohidrat ?? '-' }}</p>
                        <p class="text-xs text-orange-700 mt-1">gram</p>
                    </div>
                </div>
                @else
                <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-center">
                    <p class="text-sm font-medium text-yellow-800">Data gizi belum tersedia</p>
                    <p class="text-xs text-yellow-700 mt-1">Menu ini belum memiliki catatan data gizi</p>
                </div>
                @endif
            </div>

            <div class="mt-6 rounded-lg border border-slate-200 bg-white shadow-sm p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Informasi Sistem</h2>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span class="text-slate-600">Dibuat pada</span>
                        <span class="font-medium text-slate-900">{{ $menu->created_at->format('d M Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-600">Diperbarui</span>
                        <span class="font-medium text-slate-900">{{ $menu->updated_at->format('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
