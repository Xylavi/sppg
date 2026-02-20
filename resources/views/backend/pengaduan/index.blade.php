@extends('layouts.backend')

@section('content')
    <div class="mb-6 flex flex-wrap items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold">Kelola Pengaduan</h1>
            <p class="text-sm text-slate-600">Monitor laporan masyarakat dan lanjutkan proses penanganan.</p>
        </div>
    </div>

    <form method="GET" class="mb-4 flex flex-wrap items-end gap-3 rounded-lg bg-white p-4 shadow">
        <label class="text-sm font-medium text-slate-700">
            Filter Status
            <select name="status" class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2 text-sm">
                <option value="">Semua status</option>
                @foreach (['terkirim', 'dibaca', 'diproses', 'selesai'] as $status)
                    <option value="{{ $status }}" @selected($selectedStatus === $status)>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </label>

        <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Terapkan</button>
    </form>

    <div class="overflow-hidden rounded-lg bg-white shadow">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Tiket</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Kategori</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Status</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Tanggal</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-600">Aksi</th>
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
