@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Rekap Porsi Per Sekolah</h1>
        <p class="text-sm text-slate-600">Lihat rekapitulasi jumlah porsi yang diberikan ke setiap sekolah</p>
    </div>

    <!-- Summary Stats -->
    <div class="grid gap-4 md:grid-cols-3 mb-8">
        <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Total Porsi Keseluruhan</p>
            <p class="mt-2 text-3xl font-bold text-cyan-700">{{ $totalPorsi }}</p>
            <p class="text-xs text-slate-600 mt-1">Porsi yang diberikan</p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Total Menu</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $totalMenus }}</p>
            <p class="text-xs text-slate-600 mt-1">Menu yang tercatat</p>
        </div>
        <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Jumlah Sekolah</p>
            <p class="mt-2 text-3xl font-bold text-slate-900">{{ $porsiRecap->count() }}</p>
            <p class="text-xs text-slate-600 mt-1">Sekolah penerima</p>
        </div>
    </div>

    <!-- Rekap Table -->
    @if ($porsiRecap->count() > 0)
    <div class="rounded-lg border border-slate-200 bg-white shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50">
                        <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Nama Sekolah</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900">Total Porsi</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900">Jumlah Menu</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900">Rata-rata/Menu</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($porsiRecap as $recap)
                    <tr class="border-b border-slate-200 hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $recap['school_name'] }}</td>
                        <td class="px-6 py-4 text-right">
                            <span class="inline-flex rounded-lg bg-cyan-100 px-3 py-1 text-sm font-bold text-cyan-700">
                                {{ $recap['total_porsi'] }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium text-slate-900">{{ $recap['menu_count'] }}</td>
                        <td class="px-6 py-4 text-right text-sm font-medium text-slate-900">{{ $recap['menu_count'] > 0 ? round($recap['total_porsi'] / $recap['menu_count'], 1) : 0 }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <div class="w-24 bg-slate-200 rounded-full h-2">
                                    <div class="bg-cyan-700 h-2 rounded-full" style="width: {{ $totalPorsi > 0 ? ($recap['total_porsi'] / $totalPorsi) * 100 : 0 }}%"></div>
                                </div>
                                <span class="text-sm font-medium text-slate-900 w-12 text-right">{{ $totalPorsi > 0 ? round(($recap['total_porsi'] / $totalPorsi) * 100, 1) : 0 }}%</span>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Alternative: Cards View -->
    <div class="mt-8">
        <h2 class="text-lg font-semibold text-slate-900 mb-4">Tampilan Kartu</h2>
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($porsiRecap as $recap)
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">{{ $recap['school_name'] }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-lg bg-cyan-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="border-b border-slate-200 pb-3">
                        <p class="text-xs text-slate-500 font-semibold uppercase mb-1">Total Porsi</p>
                        <p class="text-3xl font-bold text-cyan-700">{{ $recap['total_porsi'] }}</p>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <p class="text-xs text-slate-500 font-semibold uppercase mb-1">Menu</p>
                            <p class="text-lg font-bold text-slate-900">{{ $recap['menu_count'] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 font-semibold uppercase mb-1">Rata-rata</p>
                            <p class="text-lg font-bold text-slate-900">{{ $recap['menu_count'] > 0 ? round($recap['total_porsi'] / $recap['menu_count'], 1) : 0 }}</p>
                        </div>
                    </div>

                    <div class="pt-3">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-xs text-slate-500 font-semibold">Persentase</p>
                            <p class="text-sm font-bold text-slate-900">{{ $totalPorsi > 0 ? round(($recap['total_porsi'] / $totalPorsi) * 100, 1) : 0 }}%</p>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-2">
                            <div class="bg-cyan-700 h-2 rounded-full" style="width: {{ $totalPorsi > 0 ? ($recap['total_porsi'] / $totalPorsi) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="rounded-lg border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
        <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
        </svg>
        <h3 class="mt-2 text-lg font-semibold text-slate-900">Belum ada data porsi</h3>
        <p class="mt-1 text-sm text-slate-600">Tambahkan menu dengan porsi untuk melihat rekap di sini</p>
    </div>
    @endif
</div>
@endsection
