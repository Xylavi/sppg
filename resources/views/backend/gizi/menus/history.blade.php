@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Riwayat Menu MBG</h1>
        <p class="text-sm text-slate-600">Lihat dan kelola riwayat menu yang telah disajikan</p>
    </div>

    <!-- Filters -->
    <div class="mb-6 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
        <form method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-48">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Filter Bulan</label>
                <select name="bulan" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700">
                    <option value="">Semua bulan</option>
                    @foreach ($months as $m)
                    @php
                        $date = \Carbon\Carbon::createFromFormat('Y-m', $m);
                        $label = $date->format('F Y');
                    @endphp
                    <option value="{{ $m }}" @selected($selectedMonth === $m)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex-1 min-w-48">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Filter Sekolah</label>
                <select name="sekolah" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700">
                    <option value="">Semua sekolah</option>
                    @foreach ($schools as $s)
                    <option value="{{ $s->id }}" @selected($selectedSchool == $s->id)>{{ $s->nama_sekolah }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                Terapkan Filter
            </button>
        </form>
    </div>

    <!-- Menu History List -->
    <div class="space-y-4">
        @forelse ($menus as $menu)
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h3 class="text-lg font-semibold text-slate-900">{{ $menu->nama_menu }}</h3>
                        <span class="inline-flex rounded-full bg-purple-100 px-2.5 py-0.5 text-xs font-semibold text-purple-700">
                            {{ $menu->porsi }} porsi
                        </span>
                        @if ($menu->nutrition)
                        <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-700">
                            Tercatat
                        </span>
                        @else
                        <span class="inline-flex rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-semibold text-yellow-700">
                            Belum Tercatat
                        </span>
                        @endif
                    </div>

                    <div class="grid gap-4 md:grid-cols-2 mb-3">
                        <div>
                            <p class="text-sm text-slate-600">
                                <span class="font-medium text-slate-900">Tanggal:</span> {{ $menu->tanggal_menu->format('d F Y') }}
                            </p>
                            <p class="text-sm text-slate-600">
                                <span class="font-medium text-slate-900">Sekolah:</span> {{ $menu->school->nama_sekolah }}
                            </p>
                        </div>

                        @if ($menu->nutrition)
                        <div class="grid grid-cols-4 gap-2">
                            <div class="rounded bg-blue-50 p-2">
                                <p class="text-xs text-blue-600 font-semibold">Energi</p>
                                <p class="text-sm font-bold text-blue-900">{{ $menu->nutrition->energi }}</p>
                            </div>
                            <div class="rounded bg-green-50 p-2">
                                <p class="text-xs text-green-600 font-semibold">Protein</p>
                                <p class="text-sm font-bold text-green-900">{{ $menu->nutrition->protein }}</p>
                            </div>
                            <div class="rounded bg-yellow-50 p-2">
                                <p class="text-xs text-yellow-600 font-semibold">Lemak</p>
                                <p class="text-sm font-bold text-yellow-900">{{ $menu->nutrition->lemak }}</p>
                            </div>
                            <div class="rounded bg-orange-50 p-2">
                                <p class="text-xs text-orange-600 font-semibold">Karbo</p>
                                <p class="text-sm font-bold text-orange-900">{{ $menu->nutrition->karbohidrat }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <a href="{{ route('gizi.menus.show', $menu) }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 whitespace-nowrap">
                    Lihat Detail
                </a>
            </div>
        </div>
        @empty
        <div class="rounded-lg border border-slate-200 bg-white p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12H3m0 0l6-6m0 12l-6 6m12-12h6m0 0l-6-6m0 12l6 6"/>
            </svg>
            <h3 class="mt-2 text-lg font-semibold text-slate-900">Tidak ada riwayat menu</h3>
            <p class="mt-1 text-sm text-slate-600">Belum ada menu yang disajikan dengan filter tersebut</p>
        </div>
        @endforelse
    </div>

    @if ($menus->hasPages())
    <div class="mt-8">
        {{ $menus->links() }}
    </div>
    @endif
</div>
@endsection
