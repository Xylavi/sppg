@extends('layouts.frontend')

@section('title', 'SPPG | Menu Hari Ini')

@section('content')
    <section class="mb-8 rounded-2xl bg-gradient-to-r from-cyan-700 to-sky-600 p-6 text-white md:p-8">
        <p class="mb-2 inline-flex rounded-full bg-white/20 px-3 py-1 text-xs font-semibold tracking-wide">Program MBG SPPG</p>
        <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Menu Hari Ini</h1>
        <p class="mt-2 max-w-2xl text-cyan-50">Informasi menu, gizi, dan layanan pengaduan masyarakat dalam satu portal publik yang transparan.</p>
        <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('frontend.pengaduan') }}" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-cyan-800 hover:bg-cyan-50">Kirim Pengaduan</a>
            <a href="{{ route('frontend.aduan-publik') }}" class="rounded-lg border border-white/40 px-4 py-2 text-sm font-semibold text-white hover:bg-white/10">Lihat Aduan Publik</a>
        </div>
    </section>

    @if ($menusToday->isEmpty())
        <div class="rounded-xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">
            Belum ada menu yang dijadwalkan untuk hari ini.
        </div>
    @else
        <section class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($menusToday as $menu)
                <article class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
                    <img src="{{ $menu->foto_menu }}" alt="{{ $menu->nama_menu }}" class="h-44 w-full object-cover"
                        onerror="this.src='https://placehold.co/800x450?text=Foto+Menu'">
                    <div class="space-y-2 p-4">
                        <h2 class="text-lg font-semibold">{{ $menu->nama_menu }}</h2>
                        <p class="text-sm text-slate-600">{{ $menu->tanggal_menu->translatedFormat('d F Y') }}</p>
                        <p class="text-sm text-slate-600">{{ $menu->school?->nama_sekolah ?? '-' }}</p>
                        <a href="{{ route('frontend.menu-detail', $menu) }}"
                            class="mt-2 inline-flex rounded-lg bg-cyan-700 px-4 py-2 text-sm font-semibold text-white hover:bg-cyan-800">Lihat
                            Detail Gizi</a>
                    </div>
                </article>
            @endforeach
        </section>
    @endif
@endsection
