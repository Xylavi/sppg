@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="mb-2 text-3xl font-bold text-slate-900">Statistik Pengaduan</h1>
                <p class="text-sm text-slate-600">Analisis dan ringkasan data pengaduan masyarakat</p>
            </div>
            <a href="{{ route('admin.complaints.index') }}" class="rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                Kembali ke Daftar
            </a>
        </div>
    </div>

    <!-- Overview Cards -->
    <div class="mb-8 grid gap-4 md:grid-cols-5">
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-2">Total Pengaduan</p>
            <p class="text-4xl font-bold text-slate-900">{{ $totalComplaints }}</p>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-2">Terkirim</p>
            <p class="text-4xl font-bold text-gray-600">{{ $complaintsByStatus->get('terkirim')?->count ?? 0 }}</p>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-2">Dibaca</p>
            <p class="text-4xl font-bold text-blue-600">{{ $complaintsByStatus->get('dibaca')?->count ?? 0 }}</p>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-2">Diproses</p>
            <p class="text-4xl font-bold text-yellow-600">{{ $complaintsByStatus->get('diproses')?->count ?? 0 }}</p>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-2">Selesai</p>
            <p class="text-4xl font-bold text-green-600">{{ $complaintsByStatus->get('selesai')?->count ?? 0 }}</p>
        </div>
    </div>

    <!-- Status Distribution -->
    <div class="mb-8 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-slate-900 mb-6">Distribusi Status Pengaduan</h2>
        
        <div class="space-y-4">
            @php
                $statusLabels = [
                    'terkirim' => 'Terkirim',
                    'dibaca' => 'Dibaca',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
                ];
                $statusColors = [
                    'terkirim' => 'bg-gray-400',
                    'dibaca' => 'bg-blue-400',
                    'diproses' => 'bg-yellow-400',
                    'selesai' => 'bg-green-400',
                ];
            @endphp
            
            @foreach ($statusLabels as $key => $label)
            @php
                $count = $complaintsByStatus->get($key)?->count ?? 0;
                $percentage = $totalComplaints > 0 ? ($count / $totalComplaints) * 100 : 0;
            @endphp
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-medium text-slate-700">{{ $label }}</span>
                    <span class="text-sm font-semibold text-slate-900">{{ $count }} ({{ number_format($percentage, 1) }}%)</span>
                </div>
                <div class="h-2 w-full rounded-full bg-slate-200 overflow-hidden">
                    <div class="h-full {{ $statusColors[$key] }}" style="width: {{ $percentage }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Category Distribution -->
    @if ($complaintsByCategory->count() > 0)
    <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-lg font-semibold text-slate-900 mb-6">Pengaduan Berdasarkan Kategori</h2>
        
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($complaintsByCategory as $item)
            <div class="rounded-lg border border-slate-200 p-4 bg-linear-to-br from-slate-50 to-slate-100">
                <p class="text-sm font-semibold text-slate-600 uppercase tracking-wide mb-2">
                    {{ ucfirst(str_replace('-', ' ', $item->kategori)) }}
                </p>
                <p class="text-3xl font-bold text-slate-900">{{ $item->count }}</p>
                <p class="text-xs text-slate-600 mt-2">
                    {{ number_format(($item->count / $totalComplaints) * 100, 1) }}% dari total
                </p>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
