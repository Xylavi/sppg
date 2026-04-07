@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="mb-2 text-3xl font-bold text-slate-900">Detail Menu</h1>
                <p class="text-sm text-slate-600">{{ $menu->tanggal_menu->format('d F Y') }}</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('gizi.menus.edit', $menu->id) }}" class="rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                    Edit Menu
                </a>
                <a href="{{ route('gizi.menus.history') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Kembali ke Riwayat
                </a>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Menu Info -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm mb-6">
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
                        <p class="mt-2 text-lg font-medium text-slate-900">{{ $menu->school->nama_sekolah }}</p>
                        <p class="mt-1 text-sm text-slate-600">{{ $menu->school->alamat }}</p>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide">Jumlah Porsi</label>
                        <p class="mt-2 text-lg font-medium text-slate-900">{{ $menu->porsi }} porsi</p>
                    </div>

                    @if ($menu->foto_menu)
                    <div>
                        <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide block mb-2">Foto Menu</label>
                        <img src="{{ asset('storage/' . $menu->foto_menu) }}" alt="{{ $menu->nama_menu }}" class="h-64 w-full rounded-lg object-cover border border-slate-200">
                    </div>
                    @endif
                </div>
            </div>

            <!-- Nutrition Details -->
            @if ($menu->nutrition)
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900 mb-6">Data Nutrisi Detail</h2>

                <div class="grid gap-4 md:grid-cols-2">
                    <div class="rounded-lg border border-blue-200 bg-blue-50 p-4">
                        <p class="text-sm font-semibold text-blue-600 uppercase tracking-wide mb-2">Energi</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $menu->nutrition->energi }}</p>
                        <p class="text-sm text-blue-700 mt-1">kilokaloris (kkal)</p>
                        <p class="text-xs text-blue-600 mt-2">Energi adalah kemampuan untuk melakukan kerja, diukur dalam kalori</p>
                    </div>

                    <div class="rounded-lg border border-green-200 bg-green-50 p-4">
                        <p class="text-sm font-semibold text-green-600 uppercase tracking-wide mb-2">Protein</p>
                        <p class="text-3xl font-bold text-green-900">{{ $menu->nutrition->protein }}</p>
                        <p class="text-sm text-green-700 mt-1">gram (gr)</p>
                        <p class="text-xs text-green-600 mt-2">Protein membangun dan memperbaiki jaringan tubuh</p>
                    </div>

                    <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">
                        <p class="text-sm font-semibold text-yellow-600 uppercase tracking-wide mb-2">Lemak</p>
                        <p class="text-3xl font-bold text-yellow-900">{{ $menu->nutrition->lemak }}</p>
                        <p class="text-sm text-yellow-700 mt-1">gram (gr)</p>
                        <p class="text-xs text-yellow-600 mt-2">Lemak menyediakan energi dan membantu penyerapan vitamin</p>
                    </div>

                    <div class="rounded-lg border border-orange-200 bg-orange-50 p-4">
                        <p class="text-sm font-semibold text-orange-600 uppercase tracking-wide mb-2">Karbohidrat</p>
                        <p class="text-3xl font-bold text-orange-900">{{ $menu->nutrition->karbohidrat }}</p>
                        <p class="text-sm text-orange-700 mt-1">gram (gr)</p>
                        <p class="text-xs text-orange-600 mt-2">Karbohidrat sumber energi utama untuk aktivitas</p>
                    </div>
                </div>
            </div>
            @else
            <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-6">
                <p class="text-sm font-medium text-yellow-800">Data nutrisi belum tersimpan untuk menu ini</p>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Status Card -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm mb-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Status</h2>

                <div class="mb-6">
                    @if ($menu->nutrition)
                    <div class="rounded-lg bg-green-100 border border-green-200 text-green-700 p-4 text-center">
                        <p class="font-semibold">✓ Data Lengkap</p>
                        <p class="text-sm mt-1">Menu dengan data nutrisi</p>
                    </div>
                    @else
                    <div class="rounded-lg bg-yellow-100 border border-yellow-200 text-yellow-700 p-4 text-center">
                        <p class="font-semibold">⚠ Data Tidak Lengkap</p>
                        <p class="text-sm mt-1">Menu tanpa data nutrisi</p>
                    </div>
                    @endif
                </div>

                <div class="text-xs text-slate-600 flex gap-2">
                    <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                    <span>Menu ini merupakan bagian dari riwayat</span>
                </div>
            </div>

            <!-- Timeline -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Informasi Sistem</h2>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1">Dibuat pada</p>
                        <p class="text-sm font-medium text-slate-900">{{ $menu->created_at->format('d M Y H:i') }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1">Diperbarui</p>
                        <p class="text-sm font-medium text-slate-900">{{ $menu->updated_at->format('d M Y H:i') }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-slate-600 uppercase tracking-wide mb-1">ID Menu</p>
                        <p class="text-sm font-mono text-slate-900">{{ $menu->id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
