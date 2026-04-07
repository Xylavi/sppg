@extends('layouts.backend')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-3">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Kelola Pengaduan</h1>
                <p class="text-sm text-slate-600 mt-1">Daftar lengkap pengaduan yang masuk dari masyarakat</p>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
        {{ session('success') }}
    </div>
    @endif

    <!-- Filters Section -->
    <div class="mb-6">
        <form method="GET" class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex flex-wrap items-end gap-4">
                <div class="flex-1 min-w-48">
                    <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Filter Status</label>
                    <select name="status" id="status" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                        <option value="">Semua Status</option>
                        <option value="terkirim" @selected($selectedStatus === 'terkirim')>Terkirim</option>
                        <option value="dibaca" @selected($selectedStatus === 'dibaca')>Dibaca</option>
                        <option value="diproses" @selected($selectedStatus === 'diproses')>Diproses</option>
                        <option value="selesai" @selected($selectedStatus === 'selesai')>Selesai</option>
                    </select>
                </div>
                <button type="submit" class="inline-flex items-center rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800 transition-colors">
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Complaints List -->
    <div class="space-y-3">
    <!-- Complaints List -->
    <div class="space-y-3">
        @forelse($complaints as $complaint)
            <div class="rounded-lg border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <!-- Ticket Header -->
                        <div class="flex items-center gap-3 mb-3">
                            <h3 class="text-base font-semibold text-slate-900">{{ $complaint->ticket_number }}</h3>
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold
                                @switch($complaint->status)
                                    @case('terkirim')
                                        bg-red-100 text-red-700
                                        @break
                                    @case('dibaca')
                                        bg-yellow-100 text-yellow-700
                                        @break
                                    @case('diproses')
                                        bg-blue-100 text-blue-700
                                        @break
                                    @case('selesai')
                                        bg-green-100 text-green-700
                                        @break
                                @endswitch
                            ">
                                {{ ucfirst($complaint->status) }}
                            </span>
                            <span class="inline-flex rounded-full bg-purple-100 px-2.5 py-1 text-xs font-semibold text-purple-700">
                                {{ ucfirst(str_replace('-', ' ', $complaint->kategori)) }}
                            </span>
                        </div>

                        <!-- Complaint Description -->
                        <p class="text-sm text-slate-700 mb-3 line-clamp-2">{{ $complaint->deskripsi }}</p>

                        <!-- Complaint Details -->
                        <div class="grid gap-3 md:grid-cols-3 text-sm text-slate-600">
                            <div>
                                <span class="font-medium text-slate-900">Pelapor:</span> {{ $complaint->nama_pelapor }}
                            </div>
                            <div>
                                <span class="font-medium text-slate-900">Kontak:</span> {{ $complaint->kontak_pelapor }}
                            </div>
                            <div>
                                <span class="font-medium text-slate-900">Tanggal:</span> {{ $complaint->created_at->format('d M Y H:i') }}
                            </div>
                        </div>

                        @if($complaint->catatan_tindak_lanjut)
                            <div class="mt-3 rounded-md bg-slate-50 p-3 border-l-4 border-amber-500">
                                <p class="text-xs font-semibold text-slate-700 uppercase mb-1">Catatan Tindak Lanjut</p>
                                <p class="text-sm text-slate-700">{{ $complaint->catatan_tindak_lanjut }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Action Button -->
                    <div class="shrink-0">
                        <a href="{{ route('backend.pengaduan.show', $complaint) }}" class="inline-flex items-center rounded-lg border border-cyan-300 px-4 py-2 text-sm font-semibold text-cyan-700 hover:bg-cyan-50 transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="rounded-lg border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <h3 class="mt-2 text-lg font-semibold text-slate-900">Belum ada pengaduan</h3>
                <p class="mt-1 text-sm text-slate-600">{{ $selectedStatus ? 'Tidak ada pengaduan dengan filter status ini' : 'Semua pengaduan akan ditampilkan di sini' }}</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if ($complaints->hasPages())
    <div class="mt-6">
        {{ $complaints->links() }}
    </div>
    @endif
</div>
@endsection
