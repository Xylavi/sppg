@extends('layouts.frontend')

@section('title', 'SPPG | Tim SPPG')

@section('content')
    <section class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Daftar Tim SPPG</h1>
        <p class="mt-2 text-slate-600">Informasi anggota tim yang bertugas di satuan layanan SPPG.</p>
    </section>

    <section class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($teams as $team)
            <article class="p-4 text-center bg-white border shadow-sm rounded-xl border-slate-200">
                <img src="{{ $team->foto }}" alt="{{ $team->nama }}"
                    class="object-cover mx-auto mb-4 rounded-full h-28 w-28"
                    onerror="this.src='https://placehold.co/300x300?text=Foto+Tim'">
                <h2 class="text-lg font-semibold">{{ $team->nama }}</h2>
                <p class="text-sm text-slate-600">{{ $team->jabatan }}</p>
            </article>
        @empty
            <p class="text-slate-500">Data tim belum tersedia.</p>
        @endforelse
    </section>
@endsection
