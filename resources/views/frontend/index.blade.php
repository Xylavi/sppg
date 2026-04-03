@extends('layouts.frontend')

@section('title', 'SPPG | Menu Hari Ini')

@section('content')
    <section class="p-6 mb-8 text-white rounded-2xl bg-linear-to-r from-cyan-700 to-sky-600 md:p-8">
        <p class="inline-flex px-3 py-1 mb-2 text-xs font-semibold tracking-wide rounded-full bg-white/20">Program MBG SPPG</p>
        <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Menu Hari Ini</h1>
        <p class="max-w-2xl mt-2 text-cyan-50">Informasi menu, gizi, dan layanan pengaduan masyarakat dalam satu portal publik yang transparan.</p>
        <div class="flex flex-wrap gap-3 mt-4">
            <a href="{{ route('frontend.pengaduan') }}" class="px-4 py-2 text-sm font-semibold bg-white rounded-lg text-cyan-800 hover:bg-cyan-50">Kirim Pengaduan</a>
            <a href="{{ route('frontend.aduan-publik') }}" class="px-4 py-2 text-sm font-semibold text-white border rounded-lg border-white/40 hover:bg-white/10">Lihat Aduan Publik</a>
        </div>
    </section>

    @if ($menusToday->isEmpty())
        <div class="p-8 text-center bg-white border border-dashed rounded-xl border-slate-300 text-slate-500">
            Belum ada menu yang dijadwalkan untuk hari ini.
        </div>
    @else
        <section class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($menusToday as $menu)
                <article class="overflow-hidden bg-white border shadow-sm rounded-xl border-slate-200">
                    <img src="{{ $menu->foto_menu }}" alt="{{ $menu->nama_menu }}" class="object-cover w-full h-44"
                        onerror="this.src='https://placehold.co/800x450?text=Foto+Menu'">
                    <div class="p-4 space-y-2">
                        <h2 class="text-lg font-semibold">{{ $menu->nama_menu }}</h2>
                        <p class="text-sm text-slate-600">{{ $menu->tanggal_menu->translatedFormat('d F Y') }}</p>
                        <p class="text-sm text-slate-600">{{ $menu->school?->nama_sekolah ?? '-' }}</p>
                        <a href="{{ route('frontend.menu-detail', $menu) }}"
                            class="inline-flex px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg bg-cyan-700 hover:bg-cyan-800">Lihat
                            Detail Gizi</a>
                    </div>
                </article>
            @endforeach
        </section>
    @endif
@endsection
