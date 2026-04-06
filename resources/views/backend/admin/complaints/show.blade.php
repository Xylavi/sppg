@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="mb-2 text-3xl font-bold text-slate-900">Detail Pengaduan</h1>
                <p class="text-sm text-slate-600">Tiket: {{ $complaint->ticket_number }}</p>
            </div>
            <a href="{{ route('admin.complaints.index') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Kembali
            </a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Informasi Pengaduan -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm mb-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-6">Informasi Pengaduan</h2>

                <div class="space-y-6">
                    <div>
                        <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide">Kategori</label>
                        <div class="mt-2">
                            <span class="inline-flex rounded-full bg-blue-100 px-3 py-1.5 text-sm font-semibold text-blue-700">
                                {{ ucfirst(str_replace('-', ' ', $complaint->kategori)) }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide">Deskripsi</label>
                        <p class="mt-2 text-slate-700 leading-relaxed">{{ $complaint->deskripsi }}</p>
                    </div>

                    @if ($complaint->foto)
                    <div>
                        <label class="text-xs font-semibold text-slate-600 uppercase tracking-wide block mb-2">Foto/Bukti</label>
                        <img src="{{ asset('storage/' . $complaint->foto) }}" alt="Bukti pengaduan" class="max-w-full h-auto rounded-lg border border-slate-200">
                    </div>
                    @endif
                </div>
            </div>

            <!-- Data Pelapor -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm mb-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-6">Data Pelapor</h2>

                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-medium text-slate-600">Nama Pelapor</label>
                        <p class="mt-1 text-slate-900">{{ $complaint->nama_pelapor }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-slate-600">Kontak Pelapor</label>
                        <p class="mt-1 text-slate-900">{{ $complaint->kontak_pelapor }}</p>
                    </div>
                </div>
            </div>

            <!-- Catatan Tindak Lanjut -->
            @if ($complaint->catatan_tindak_lanjut)
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Catatan Tindak Lanjut</h2>
                <div class="rounded-lg bg-slate-50 p-4 text-slate-700">
                    {{ $complaint->catatan_tindak_lanjut }}
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Status Card -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm mb-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Status</h2>

                <div class="mb-4">
                    @php
                        $statusColors = [
                            'terkirim' => 'bg-gray-100 text-gray-700 border-gray-200',
                            'dibaca' => 'bg-blue-100 text-blue-700 border-blue-200',
                            'diproses' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                            'selesai' => 'bg-green-100 text-green-700 border-green-200',
                        ];
                    @endphp
                    <div class="rounded-lg border {{ $statusColors[$complaint->status] ?? 'bg-slate-100 text-slate-700' }} p-3 text-center">
                        <p class="font-semibold">{{ ucfirst($complaint->status) }}</p>
                    </div>
                </div>

                <div class="flex gap-2 text-xs text-slate-600">
                    <svg class="w-4 h-4 mt-0.5 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                    </svg>
                    <span>Status dikelola oleh petugas pengaduan</span>
                </div>
            </div>

            <!-- Timeline -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Timeline</h2>

                <div class="space-y-4">
                    <div class="flex gap-3">
                        <div class="relative flex flex-col items-center">
                            <div class="w-3 h-3 rounded-full bg-cyan-700"></div>
                        </div>
                        <div class="flex-1 pb-4">
                            <p class="text-sm font-medium text-slate-900">Laporan Masuk</p>
                            <p class="text-xs text-slate-600">{{ $complaint->created_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>

                    @if ($complaint->updated_at->ne($complaint->created_at))
                    <div class="flex gap-3">
                        <div class="relative flex flex-col items-center">
                            <div class="w-3 h-3 rounded-full bg-cyan-300"></div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-900">Diperbarui</p>
                            <p class="text-xs text-slate-600">{{ $complaint->updated_at->format('d F Y H:i') }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
