@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Seluruh Data Menu</h1>
        <p class="text-sm text-slate-600">Lihat dan pantau seluruh data menu yang tersimpan</p>
    </div>

    <div class="mb-6 flex gap-3">
        <a href="{{ route('admin.menus.history') }}" class="inline-flex items-center rounded-lg border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
            Riwayat Menu
        </a>
    </div>

    <div class="overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="border-b border-slate-200 bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Tanggal</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Menu</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Sekolah</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Status Gizi</th>
                        <th class="px-6 py-3 text-left font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($menus as $menu)
                    <tr class="hover:bg-slate-50">
                        <td class="px-6 py-4 font-medium text-slate-900">{{ $menu->tanggal_menu->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ Str::limit($menu->nama_menu, 40) }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $menu->school->nama_sekolah ?? '-' }}</td>
                        <td class="px-6 py-4">
                            @if ($menu->nutrition)
                            <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-semibold text-green-700">
                                Tercatat
                            </span>
                            @else
                            <span class="inline-flex rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-semibold text-yellow-700">
                                Belum Tercatat
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.menus.show', $menu) }}" class="text-cyan-700 hover:text-cyan-800 font-medium text-sm">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500">
                            Belum ada data menu.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if ($menus->hasPages())
    <div class="mt-6">
        {{ $menus->links() }}
    </div>
    @endif
</div>
@endsection
