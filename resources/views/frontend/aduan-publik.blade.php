@extends('layouts.frontend')

@section('title', 'SPPG | Daftar Aduan Publik')

@section('content')
    <section class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">Daftar Aduan Publik</h1>
        <p class="mt-2 text-slate-600">Daftar pengaduan masyarakat tanpa menampilkan identitas pelapor.</p>
    </section>

    <section class="space-y-4">
        @forelse ($complaints as $complaint)
            <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
                <div class="flex flex-wrap items-start justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-500">Tiket {{ $complaint->ticket_number }}</p>
                        <h2 class="text-lg font-semibold text-slate-900">{{ ucfirst(str_replace('-', ' ', $complaint->kategori)) }}</h2>
                    </div>
                    @php
                        $statusColor = match ($complaint->status) {
                            'terkirim' => 'bg-sky-100 text-sky-700',
                            'dibaca' => 'bg-amber-100 text-amber-700',
                            'diproses' => 'bg-violet-100 text-violet-700',
                            'selesai' => 'bg-emerald-100 text-emerald-700',
                            default => 'bg-slate-100 text-slate-700',
                        };
                    @endphp
                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusColor }}">{{ ucfirst($complaint->status) }}</span>
                </div>

                <p class="mt-3 text-sm text-slate-700">{{ $complaint->deskripsi }}</p>
                <p class="mt-2 text-xs text-slate-500">Dikirim {{ $complaint->created_at->translatedFormat('d F Y H:i') }}</p>
            </article>
        @empty
            <p class="rounded-lg border border-dashed border-slate-300 bg-white p-6 text-sm text-slate-500">Belum ada data aduan publik.</p>
        @endforelse
    </section>
@endsection
