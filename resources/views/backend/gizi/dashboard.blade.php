@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Dashboard Petugas Gizi</h1>
        <p class="text-sm text-slate-600">Kelola menu hari ini dan pantau data gizi</p>
    </div>

    @if (session('success'))
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
        {{ session('success') }}
    </div>
    @endif

    <!-- Today's Menu Section -->
    <div class="mb-8">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-semibold text-slate-900">Menu Hari Ini</h2>
            <a href="{{ route('gizi.menus.create') }}" class="inline-flex items-center rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                + Tambah Menu
            </a>
        </div>

        @if ($todayMenu)
        <!-- Menu Exists -->
        <div class="grid gap-6 lg:grid-cols-3">
            <!-- Menu Info -->
            <div class="lg:col-span-2 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">{{ $todayMenu->nama_menu }}</h3>
                        <p class="text-sm text-slate-600 mt-1">{{ now()->format('l, d F Y') }}</p>
                    </div>
                    <a href="{{ route('gizi.menus.edit', $todayMenu) }}" class="inline-flex items-center rounded-lg border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Edit Menu
                    </a>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide">Sekolah Penerima</label>
                        <p class="mt-1 text-slate-900">{{ $todayMenu->school->nama_sekolah }}</p>
                        <p class="text-xs text-slate-600">{{ $todayMenu->school->alamat }}</p>
                    </div>

                    @if ($todayMenu->foto_menu)
                    <div>
                        <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide">Foto Menu</label>
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $todayMenu->foto_menu) }}" alt="{{ $todayMenu->nama_menu }}" class="h-48 w-full rounded-lg object-cover border border-slate-200">
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Nutrition Info -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Data Gizi</h3>

                @if ($todayMenu->nutrition)
                <div class="space-y-3">
                    <div class="rounded-lg bg-blue-50 p-3">
                        <p class="text-xs font-semibold text-blue-600 uppercase tracking-wide mb-1">Energi</p>
                        <p class="text-2xl font-bold text-blue-900">{{ $todayMenu->nutrition->energi }}</p>
                        <p class="text-xs text-blue-700">kkal</p>
                    </div>

                    <div class="rounded-lg bg-green-50 p-3">
                        <p class="text-xs font-semibold text-green-600 uppercase tracking-wide mb-1">Protein</p>
                        <p class="text-2xl font-bold text-green-900">{{ $todayMenu->nutrition->protein }}</p>
                        <p class="text-xs text-green-700">gram</p>
                    </div>

                    <div class="rounded-lg bg-yellow-50 p-3">
                        <p class="text-xs font-semibold text-yellow-600 uppercase tracking-wide mb-1">Lemak</p>
                        <p class="text-2xl font-bold text-yellow-900">{{ $todayMenu->nutrition->lemak }}</p>
                        <p class="text-xs text-yellow-700">gram</p>
                    </div>

                    <div class="rounded-lg bg-orange-50 p-3">
                        <p class="text-xs font-semibold text-orange-600 uppercase tracking-wide mb-1">Karbohidrat</p>
                        <p class="text-2xl font-bold text-orange-900">{{ $todayMenu->nutrition->karbohidrat }}</p>
                        <p class="text-xs text-orange-700">gram</p>
                    </div>
                </div>
                @else
                <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4 text-center">
                    <p class="text-sm font-medium text-yellow-800">Data gizi belum tersimpan</p>
                </div>
                @endif
            </div>
        </div>
        @else
        <!-- No Menu for Today -->
        <div class="rounded-lg border-2 border-dashed border-slate-300 bg-slate-50 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m0 0h6m0 0H6m0 0H0m0 0v6"/>
            </svg>
            <h3 class="mt-2 text-lg font-semibold text-slate-900">Belum ada menu hari ini</h3>
            <p class="mt-1 text-sm text-slate-600">Mulai dengan menambahkan menu untuk hari ini</p>
            <a href="{{ route('gizi.menus.create') }}" class="mt-4 inline-flex items-center rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                Tambah Menu Hari Ini
            </a>
        </div>
        @endif
    </div>

    <!-- Quick Info -->
    <div class="grid gap-4 md:grid-cols-3">
        <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Status Hari Ini</p>
            <p class="mt-2 text-lg font-bold text-slate-900">
                {{ $todayMenu ? '✓ Menu Tercatat' : '⊘ Belum Ada Menu' }}
            </p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Tanggal Saat Ini</p>
            <p class="mt-2 text-lg font-bold text-slate-900">{{ now()->format('d M Y') }}</p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Jam</p>
            <p class="mt-2 text-lg font-bold text-slate-900" id="current-time">{{ now()->format('H:i') }}</p>
        </div>
    </div>
</div>

<script>
    // Update time every minute
    setInterval(() => {
        const now = new Date();
        document.getElementById('current-time').textContent = 
            String(now.getHours()).padStart(2, '0') + ':' + 
            String(now.getMinutes()).padStart(2, '0');
    }, 60000);
</script>
@endsection
