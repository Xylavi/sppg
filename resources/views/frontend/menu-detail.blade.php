@extends('layouts.frontend')

@section('title', 'SPPG | Detail Gizi')

@section('content')
    <a href="{{ route('frontend.index') }}" class="mb-6 inline-flex text-sm font-medium text-cyan-700 hover:underline">← Kembali ke
        Menu Hari Ini</a>

    <article class="grid gap-6 rounded-xl border border-slate-200 bg-white p-5 shadow-sm md:grid-cols-2 md:p-8">
        <img src="{{ $menu->foto_menu }}" alt="{{ $menu->nama_menu }}" class="h-64 w-full rounded-lg object-cover"
            onerror="this.src='https://placehold.co/800x450?text=Foto+Menu'">

        <div>
            <h1 class="text-2xl font-bold">{{ $menu->nama_menu }}</h1>
            <p class="mt-2 text-slate-600">Tanggal: {{ $menu->tanggal_menu->translatedFormat('d F Y') }}</p>
            <p class="text-slate-600">Sekolah: {{ $menu->school?->nama_sekolah ?? '-' }}</p>

            <h2 class="mt-6 text-lg font-semibold">Informasi Gizi</h2>
            @if ($menu->nutrition)
                <ul class="mt-3 space-y-2 text-sm text-slate-700">
                    <li>Energi: <span class="font-semibold">{{ $menu->nutrition->energi }} kkal</span></li>
                    <li>Protein: <span class="font-semibold">{{ $menu->nutrition->protein }} gram</span></li>
                    <li>Lemak: <span class="font-semibold">{{ $menu->nutrition->lemak }} gram</span></li>
                    <li>Karbohidrat: <span class="font-semibold">{{ $menu->nutrition->karbohidrat }} gram</span></li>
                </ul>
            @else
                <p class="mt-3 text-sm text-slate-500">Informasi gizi belum tersedia.</p>
            @endif
        </div>
    </article>
@endsection
