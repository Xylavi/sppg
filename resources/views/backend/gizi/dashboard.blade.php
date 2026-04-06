@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Dashboard Petugas Gizi</h1>
        <p class="text-sm text-slate-600">Kelola menu harian dan pantau data gizi</p>
    </div>

    @if (session('success'))
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
        {{ session('success') }}
    </div>
    @endif

    <!-- Today's Status Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-slate-900">Status Hari Ini</h2>
        </div>

        <div class="grid gap-4 md:grid-cols-3">
            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Status Menu</p>
                @if ($todayMenu)
                <p class="mt-2 text-lg font-bold text-green-700">✓ Menu Tercatat</p>
                <p class="text-xs text-slate-600 mt-1">{{ $todayMenu->nama_menu }}</p>
                @else
                <p class="mt-2 text-lg font-bold text-yellow-700">⊘ Belum Ada Menu</p>
                <p class="text-xs text-slate-600 mt-1">Tambahkan menu untuk hari ini</p>
                @endif
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Tanggal</p>
                <p class="mt-2 text-lg font-bold text-slate-900">{{ now()->format('d M Y') }}</p>
                <p class="text-xs text-slate-600 mt-1">{{ now()->format('l') }}</p>
            </div>
            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Total Menu</p>
                <p class="mt-2 text-lg font-bold text-slate-900">{{ $totalMenus }}</p>
                <p class="text-xs text-slate-600 mt-1">Menu yang tersimpan</p>
            </div>
        </div>
    </div>

    <!-- Quick Links Section -->
    <div class="mb-8">
        <div class="grid gap-4 md:grid-cols-2">
            <a href="{{ route('gizi.porsi-recap') }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md hover:border-cyan-300 transition-all">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Rekap Porsi Per Sekolah</h3>
                        <p class="text-sm text-slate-600 mt-1">Lihat rekapitulasi jumlah porsi untuk setiap sekolah</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('gizi.menus.history') }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md hover:border-cyan-300 transition-all">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Riwayat Menu</h3>
                        <p class="text-sm text-slate-600 mt-1">Lihat dan kelola riwayat menu yang telah disajikan</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Manage All Menus Section -->
    <div>
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-slate-900">Kelola Semua Menu</h2>
            <a href="{{ route('gizi.menus.create') }}" class="inline-flex items-center rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                + Tambah Menu Baru
            </a>
        </div>

        <!-- Menu List -->
        <div class="space-y-3">
            @forelse ($recentMenus as $menu)
            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="text-base font-semibold text-slate-900">{{ $menu->nama_menu }}</h3>
                            <span class="inline-flex rounded-full bg-purple-100 px-2 py-0.5 text-xs font-semibold text-purple-700">
                                {{ $menu->porsi }} porsi
                            </span>
                            @if ($menu->nutrition)
                            <span class="inline-flex rounded-full bg-green-100 px-2 py-0.5 text-xs font-semibold text-green-700">
                                Tercatat
                            </span>
                            @else
                            <span class="inline-flex rounded-full bg-yellow-100 px-2 py-0.5 text-xs font-semibold text-yellow-700">
                                Belum Tercatat
                            </span>
                            @endif
                        </div>

                        <div class="grid gap-3 md:grid-cols-3 text-sm text-slate-600">
                            <div>
                                <span class="font-medium text-slate-900">Tanggal:</span> {{ $menu->tanggal_menu->format('d M Y') }}
                            </div>
                            <div>
                                <span class="font-medium text-slate-900">Sekolah:</span> {{ $menu->school->nama_sekolah }}
                            </div>
                            @if ($menu->nutrition)
                            <div class="flex gap-3">
                                <div class="text-xs">
                                    <span class="font-semibold text-blue-700">Energi:</span>
                                    <span class="font-bold text-blue-900">{{ $menu->nutrition->energi }} kkal</span>
                                </div>
                                <div class="text-xs">
                                    <span class="font-semibold text-green-700">Protein:</span>
                                    <span class="font-bold text-green-900">{{ $menu->nutrition->protein }} g</span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex gap-2 shrink-0">
                        <a href="{{ route('gizi.menus.edit', $menu) }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Edit
                        </a>
                        <a href="{{ route('gizi.menus.show', $menu) }}" class="rounded-lg border border-cyan-300 px-3 py-2 text-sm font-semibold text-cyan-700 hover:bg-cyan-50">
                            Lihat
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="rounded-lg border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m0 0h6m0 0H6m0 0H0m0 0v6"/>
                </svg>
                <h3 class="mt-2 text-lg font-semibold text-slate-900">Belum ada menu</h3>
                <p class="mt-1 text-sm text-slate-600">Mulai dengan menambahkan menu baru</p>
                <a href="{{ route('gizi.menus.create') }}" class="mt-4 inline-flex items-center rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                    Tambah Menu Pertama
                </a>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($recentMenus->hasPages())
        <div class="mt-6">
            {{ $recentMenus->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
