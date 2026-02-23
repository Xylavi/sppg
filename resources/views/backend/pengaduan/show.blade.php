@extends('layouts.backend')

@section('content')
    <a href="{{ route('backend.pengaduan.index') }}" class="mb-4 inline-flex text-sm text-blue-600 hover:underline">← Kembali ke daftar</a>

    <div class="rounded-lg bg-white p-6 shadow">
        <h1 class="text-2xl font-bold">Detail Pengaduan</h1>

        @if (session('success'))
            <div class="mt-4 rounded-md border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('success') }}
            </div>
        @endif


        @if ($errors->any())
            <div class="mt-4 rounded-md border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <dl class="mt-5 grid gap-4 md:grid-cols-2">
            <div>
                <dt class="text-xs uppercase tracking-wide text-slate-500">Nomor Tiket</dt>
                <dd class="font-semibold text-slate-800">{{ $complaint->ticket_number }}</dd>
            </div>
            <div>
                <dt class="text-xs uppercase tracking-wide text-slate-500">Kategori</dt>
                <dd class="font-semibold text-slate-800">{{ ucfirst(str_replace('-', ' ', $complaint->kategori)) }}</dd>
            </div>
            <div>
                <dt class="text-xs uppercase tracking-wide text-slate-500">Pelapor</dt>
                <dd class="font-semibold text-slate-800">{{ $complaint->nama_pelapor ?? 'Anonim' }}</dd>
            </div>
            <div>
                <dt class="text-xs uppercase tracking-wide text-slate-500">Kontak</dt>
                <dd class="font-semibold text-slate-800">{{ $complaint->kontak_pelapor ?? '-' }}</dd>
            </div>
            <div class="md:col-span-2">
                <dt class="text-xs uppercase tracking-wide text-slate-500">Deskripsi</dt>
                <dd class="font-medium text-slate-700">{{ $complaint->deskripsi }}</dd>
            </div>
        </dl>

        <form method="POST" action="{{ route('backend.pengaduan.update', $complaint) }}" class="mt-6 space-y-4 rounded-lg border border-slate-200 p-4">
            @csrf
            @method('PUT')

            <label class="block text-sm font-medium text-slate-700">Status
                <select name="status" class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm">
                    @foreach (['terkirim', 'dibaca', 'diproses', 'selesai'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $complaint->status) === $status)>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </label>

            <label class="block text-sm font-medium text-slate-700">Catatan Tindak Lanjut
                <textarea name="catatan_tindak_lanjut" rows="4" class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm">{{ old('catatan_tindak_lanjut', $complaint->catatan_tindak_lanjut) }}</textarea>
            </label>

            <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Simpan Perubahan</button>
        </form>
    </div>
@endsection
