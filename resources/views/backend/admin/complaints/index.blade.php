@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="mb-2 text-3xl font-bold text-slate-900">Monitor Pengaduan Masyarakat</h1>
                <p class="text-sm text-slate-600">Pantau dan analisis seluruh pengaduan yang masuk dari publik</p>
            </div>
            <a href="{{ route('admin.complaints.statistics') }}" class="rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                Lihat Statistik
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="mb-6 rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
        <form method="GET" class="flex flex-wrap items-end gap-4">
            <div class="flex-1 min-w-48">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Filter Status</label>
                <select name="status" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700">
                    <option value="">Semua status</option>
                    @foreach (['terkirim', 'dibaca', 'diproses', 'selesai'] as $s)
                    <option value="{{ $s }}" @selected($selectedStatus === $s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>

            @if ($categories->count() > 0)
            <div class="flex-1 min-w-48">
                <label class="block text-sm font-semibold text-slate-700 mb-2">Filter Kategori</label>
                <select name="kategori" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700">
                    <option value="">Semua kategori</option>
                    @foreach ($categories as $cat)
                    <option value="{{ $cat }}" @selected($selectedKategori === $cat)>{{ ucfirst(str_replace('-', ' ', $cat)) }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            <button type="submit" class="rounded-lg bg-cyan-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                Terapkan Filter
            </button>
        </form>
    </div>

    <!-- Complaints Table -->
    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Tiket</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Kategori</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Pelapor</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Status</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Tanggal</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($complaints as $complaint)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $complaint->ticket_number }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-semibold text-blue-700">
                                {{ ucfirst(str_replace('-', ' ', $complaint->kategori)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $complaint->nama_pelapor }}</td>
                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'terkirim' => 'bg-gray-100 text-gray-700',
                                    'dibaca' => 'bg-blue-100 text-blue-700',
                                    'diproses' => 'bg-yellow-100 text-yellow-700',
                                    'selesai' => 'bg-green-100 text-green-700',
                                ];
                            @endphp
                            <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-semibold {{ $statusColors[$complaint->status] ?? 'bg-slate-100 text-slate-700' }}">
                                {{ ucfirst($complaint->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ $complaint->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.complaints.show', $complaint) }}" class="text-cyan-700 hover:text-cyan-800 font-medium text-sm">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500">
                            Belum ada data pengaduan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($complaints->hasPages())
    <div class="mt-6">
        {{ $complaints->links() }}
    </div>
    @endif
</div>
@endsection
