@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Riwayat Menu</h1>
        <p class="text-sm text-slate-600">Pantau dan analisis riwayat seluruh menu yang pernah disajikan</p>
    </div>

    <div class="mb-6 flex gap-3">
        <a href="{{ route('admin.menus.index') }}" class="inline-flex items-center rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
            Kembali
        </a>
    </div>

    <div class="grid gap-6">
        @php
            $menusByMonth = $menus->groupBy(fn($menu) => $menu->tanggal_menu->format('Y-m'));
        @endphp

        @forelse ($menusByMonth as $month => $monthMenus)
        <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
            <div class="border-b border-slate-200 bg-slate-50 px-6 py-4">
                <h3 class="text-lg font-semibold text-slate-900">
                    {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}
                </h3>
                <p class="text-sm text-slate-600 mt-1">{{ $monthMenus->count() }} menu</p>
            </div>

            <div class="divide-y divide-slate-100">
                @foreach ($monthMenus as $menu)
                <div class="px-6 py-4 hover:bg-slate-50">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <p class="font-semibold text-slate-900">{{ $menu->tanggal_menu->format('d M Y') }}</p>
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
                            <p class="text-slate-600 mb-1">
                                <span class="font-medium text-slate-900">Menu:</span> {{ $menu->nama_menu }}
                            </p>
                            <p class="text-slate-600">
                                <span class="font-medium text-slate-900">Sekolah:</span> {{ $menu->school->nama_sekolah ?? '-' }}
                            </p>

                            @if ($menu->nutrition)
                            <div class="mt-3 grid grid-cols-4 gap-3 text-sm">
                                <div class="rounded bg-blue-50 p-2">
                                    <p class="text-slate-600 text-xs">Energi</p>
                                    <p class="font-semibold text-slate-900">{{ $menu->nutrition->energi ?? '-' }}</p>
                                </div>
                                <div class="rounded bg-green-50 p-2">
                                    <p class="text-slate-600 text-xs">Protein</p>
                                    <p class="font-semibold text-slate-900">{{ $menu->nutrition->protein ?? '-' }}</p>
                                </div>
                                <div class="rounded bg-yellow-50 p-2">
                                    <p class="text-slate-600 text-xs">Lemak</p>
                                    <p class="font-semibold text-slate-900">{{ $menu->nutrition->lemak ?? '-' }}</p>
                                </div>
                                <div class="rounded bg-orange-50 p-2">
                                    <p class="text-slate-600 text-xs">Karbohidrat</p>
                                    <p class="font-semibold text-slate-900">{{ $menu->nutrition->karbohidrat ?? '-' }}</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        <a href="{{ route('admin.menus.show', $menu) }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50 whitespace-nowrap">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="rounded-lg border border-slate-200 bg-white p-8 text-center">
            <p class="text-slate-500">Belum ada data riwayat menu.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
