@extends('layouts.backend')

@section('content')
<div>
    <!-- Header -->
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Dashboard Pengaduan</h1>
        <p class="text-sm text-slate-600">Monitor laporan masyarakat dan analisis statistik pengaduan</p>
    </div>

    @if (session('success'))
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
        {{ session('success') }}
    </div>
    @endif

    <!-- Statistics Section -->
    <div class="mb-8">
        <h2 class="mb-4 text-xl font-semibold text-slate-900">Statistik Pengaduan</h2>
        <div class="grid gap-4 md:grid-cols-5">
            <!-- Total Complaints -->
            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Total</p>
                <p class="mt-3 text-2xl font-bold text-slate-900">{{ $totalComplaints }}</p>
                <p class="text-xs text-slate-600 mt-1">Semua Pengaduan</p>
            </div>

            <!-- New Complaints -->
            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Baru</p>
                        <p class="mt-3 text-2xl font-bold text-red-700">{{ $newComplaints }}</p>
                        <p class="text-xs text-slate-600 mt-1">Terkirim</p>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-red-700" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Read Complaints -->
            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Dibaca</p>
                        <p class="mt-3 text-2xl font-bold text-yellow-700">{{ $readComplaints }}</p>
                        <p class="text-xs text-slate-600 mt-1">Sudah Dibaca</p>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-yellow-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-yellow-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- In Progress Complaints -->
            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Diproses</p>
                        <p class="mt-3 text-2xl font-bold text-blue-700">{{ $inProgressComplaints }}</p>
                        <p class="text-xs text-slate-600 mt-1">Sedang Diproses</p>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Resolved Complaints -->
            <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide">Selesai</p>
                        <p class="mt-3 text-2xl font-bold text-green-700">{{ $resolvedComplaints }}</p>
                        <p class="text-xs text-slate-600 mt-1">Terpecahkan</p>
                    </div>
                    <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-green-700" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 lg:grid-cols-3 mb-8">
        <!-- Complaints by Category -->
        <div class="lg:col-span-2 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-slate-900">Pengaduan Berdasarkan Kategori</h2>

            @if($complaintsByCategory->count() > 0)
                <div class="space-y-4">
                    @foreach($complaintsByCategory as $category)
                        @php
                            $percentage = $totalComplaints > 0 ? round(($category->count / $totalComplaints) * 100) : 0;
                        @endphp
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-slate-900">{{ ucfirst(str_replace('-', ' ', $category->kategori)) }}</span>
                                <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-700">
                                    {{ $category->count }}
                                </span>
                            </div>
                            <div class="h-2 w-full rounded-full bg-slate-200 overflow-hidden">
                                <div class="h-full bg-linear-to-r from-cyan-500 to-cyan-700 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                            <span class="text-xs text-slate-600">{{ $percentage }}%</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center text-slate-500 py-8">
                    <p class="text-sm">Belum ada data kategori pengaduan</p>
                </div>
            @endif
        </div>

        <!-- Quick Stats Card -->
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="mb-5 text-lg font-semibold text-slate-900">Ringkasan Cepat</h2>

            <div class="space-y-4">
                <!-- Resolution Rate -->
                <div class="rounded-lg bg-linear-to-br from-green-50 to-emerald-50 p-4 border border-green-200">
                    <p class="text-xs font-semibold text-green-700 uppercase">Tingkat Penyelesaian</p>
                    <p class="mt-2 text-2xl font-bold text-green-900">
                        {{ $totalComplaints > 0 ? round(($resolvedComplaints / $totalComplaints) * 100) : 0 }}%
                    </p>
                    <p class="text-xs text-green-700 mt-1">dari total pengaduan</p>
                </div>

                <!-- Average Resolution Time -->
                <div class="rounded-lg bg-linear-to-br from-blue-50 to-cyan-50 p-4 border border-blue-200">
                    <p class="text-xs font-semibold text-blue-700 uppercase">Rata-rata Waktu</p>
                    <p class="mt-2 text-2xl font-bold text-blue-900">{{ $avgResolutionDays }}</p>
                    <p class="text-xs text-blue-700 mt-1">hari penyelesaian</p>
                </div>

                <!-- Pending Rate -->
                <div class="rounded-lg bg-linear-to-br from-amber-50 to-orange-50 p-4 border border-amber-200">
                    <p class="text-xs font-semibold text-amber-700 uppercase">Belum Selesai</p>
                    @php
                        $pendingCount = $totalComplaints - $resolvedComplaints;
                        $pendingPercentage = $totalComplaints > 0 ? round(($pendingCount / $totalComplaints) * 100) : 0;
                    @endphp
                    <p class="mt-2 text-2xl font-bold text-amber-900">{{ $pendingPercentage }}%</p>
                    <p class="text-xs text-amber-700 mt-1">masih dalam proses</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links Section -->
    <div class="mb-8">
        <h2 class="mb-4 text-xl font-semibold text-slate-900">Akses Cepat</h2>
        <div class="grid gap-4 md:grid-cols-2">
            <a href="{{ route('backend.pengaduan.index') }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md hover:border-cyan-300 transition-all">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-lg bg-cyan-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Kelola Pengaduan</h3>
                        <p class="text-sm text-slate-600 mt-1">Lihat daftar lengkap dan kelola status pengaduan yang masuk</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('backend.pengaduan.index', ['status' => 'terkirim']) }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md hover:border-red-300 transition-all">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-lg bg-red-100 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-red-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Pengaduan Baru</h3>
                        <p class="text-sm text-slate-600 mt-1">Lihat <span class="font-semibold">{{ $newComplaints }}</span> pengaduan yang baru masuk</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Complaints Section -->
    <div>
        <h2 class="mb-4 text-xl font-semibold text-slate-900">Pengaduan Terbaru</h2>

        <div class="space-y-3">
            @forelse($recentComplaints as $complaint)
                <a href="{{ route('backend.pengaduan.show', $complaint) }}" class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm hover:shadow-md hover:border-cyan-300 transition-all">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
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
                            <p class="text-sm text-slate-700 line-clamp-1">{{ $complaint->deskripsi }}</p>
                            <p class="text-xs text-slate-600 mt-2">{{ $complaint->created_at->diffForHumans() }} • {{ $complaint->nama_pelapor ?? 'Anonim' }}</p>
                        </div>
                        <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            @empty
                <div class="rounded-lg border border-dashed border-slate-300 bg-slate-50 p-8 text-center">
                    <p class="text-sm text-slate-600">Belum ada pengaduan</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
