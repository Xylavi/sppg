@extends('layouts.backend')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-bold">Kelola Pengaduan</h1>
            <p class="text-sm text-slate-600">Monitor laporan masyarakat dan lanjutkan proses penanganan.</p>
        </div>
    </div>

    <form method="GET" class="flex flex-wrap items-end gap-3 p-4 mb-4 bg-white rounded-lg shadow">
        <label class="text-sm font-medium text-slate-700">
            Filter Status
            <select name="status" class="w-full px-3 py-2 mt-1 text-sm border rounded-md border-slate-300">
                <option value="">Semua status</option>
                @foreach (['terkirim', 'dibaca', 'diproses', 'selesai'] as $status)
                    <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </label>

        <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded-md hover:bg-blue-700">Terapkan</button>
    </form>

    <div class="overflow-hidden bg-white rounded-lg shadow">
        <table class="min-w-full text-sm divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 font-semibold text-left text-slate-600">Tiket</th>
                    <th class="px-4 py-3 font-semibold text-left text-slate-600">Kategori</th>
                    <th class="px-4 py-3 font-semibold text-left text-slate-600">Status</th>
                    <th class="px-4 py-3 font-semibold text-left text-slate-600">Tanggal</th>
                    <th class="px-4 py-3 font-semibold text-left text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($complaints as $complaint)
                    <tr>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $complaint->ticket_number }}</td>
                        <td class="px-4 py-3">{{ ucfirst(str_replace('-', ' ', $complaint->kategori)) }}</td>
                        <td class="px-4 py-3">{{ ucfirst($complaint->status) }}</td>
                        <td class="px-4 py-3">{{ $complaint->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('backend.pengaduan.show', $complaint) }}" class="text-blue-600 hover:underline">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-5 text-center text-slate-500">Belum ada data pengaduan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $complaints->links() }}</div>
@endsection
