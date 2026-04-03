@extends('layouts.frontend')

@section('title', 'SPPG | Cek Status Tiket')

@section('content')
    <section class="p-6 mb-8 text-white rounded-2xl bg-linear-to-r from-cyan-700 to-sky-600 md:p-8">
        <p class="inline-flex px-3 py-1 mb-2 text-xs font-semibold tracking-wide rounded-full bg-white/20">Pelacakan Pengaduan</p>
        <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Cek Status Tiket</h1>
        <p class="max-w-2xl mt-2 text-cyan-50">Masukkan nomor tiket untuk melihat progres penanganan pengaduan Anda secara transparan.</p>
    </section>

    <section class="p-5 bg-white border shadow-sm rounded-xl border-slate-200">
        <form method="GET" action="{{ route('frontend.cek-tiket') }}" class="grid gap-3 md:grid-cols-[1fr_auto]">
            <label class="text-sm font-medium text-slate-700">
                Nomor Tiket
                <input type="text" name="ticket" value="{{ old('ticket', $ticket) }}" placeholder="Contoh: SPPG-20260402-0001"
                    class="w-full px-3 py-2 mt-1 uppercase border rounded-lg border-slate-300" />
            </label>
            <button type="submit" class="self-end rounded-lg bg-cyan-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">Cek Status</button>
        </form>

        @if ($errors->any())
            <div class="p-3 mt-4 text-sm border rounded-lg border-rose-200 bg-rose-50 text-rose-700">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </section>

    @if ($hasQuery)
        @if ($complaint)
            @php
                $statusColor = match ($complaint->status) {
                    'terkirim' => 'bg-sky-100 text-sky-700',
                    'dibaca' => 'bg-amber-100 text-amber-700',
                    'diproses' => 'bg-violet-100 text-violet-700',
                    'selesai' => 'bg-emerald-100 text-emerald-700',
                    default => 'bg-slate-100 text-slate-700',
                };
            @endphp

            <section class="p-5 mt-6 bg-white border shadow-sm rounded-xl border-slate-200">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="text-xs font-semibold tracking-wide uppercase text-slate-500">Nomor Tiket</p>
                        <p class="text-lg font-bold text-slate-900">{{ $complaint->ticket_number }}</p>
                    </div>
                    <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $statusColor }}">{{ ucfirst($complaint->status) }}</span>
                </div>

                <dl class="grid gap-3 mt-4 text-sm text-slate-700 md:grid-cols-2">
                    <div>
                        <dt class="font-semibold text-slate-900">Kategori</dt>
                        <dd>{{ ucfirst(str_replace('-', ' ', $complaint->kategori)) }}</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-slate-900">Tanggal Kirim</dt>
                        <dd>{{ $complaint->created_at->translatedFormat('d F Y H:i') }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="font-semibold text-slate-900">Deskripsi</dt>
                        <dd>{{ $complaint->deskripsi }}</dd>
                    </div>
                    <div class="md:col-span-2">
                        <dt class="font-semibold text-slate-900">Catatan Tindak Lanjut</dt>
                        <dd>{{ $complaint->catatan_tindak_lanjut ?: 'Belum ada catatan tindak lanjut.' }}</dd>
                    </div>
                </dl>
            </section>
        @else
            <section class="p-5 mt-6 text-sm bg-white border border-dashed rounded-xl border-slate-300 text-slate-600">
                Nomor tiket <span class="font-semibold text-slate-900">{{ $ticket }}</span> tidak ditemukan.
            </section>
        @endif
    @endif
@endsection
