@extends('layouts.backend')

@section('content')

<div class="container mt-4">
    <h2>Daftar Menu</h2>

    <a href="{{ route('gizi.menus.create') }}" class="mb-3 btn btn-primary">
        Tambah Menu
    </a>

    <table class="w-full border border-collapse border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left border border-gray-300">Nama Menu</th>
                <th class="px-4 py-2 text-left border border-gray-300">Tanggal</th>
                <th class="px-4 py-2 text-left border border-gray-300">Energi</th>
                <th class="px-4 py-2 text-left border border-gray-300">Protein</th>
                <th class="px-4 py-2 text-left border border-gray-300">Lemak</th>
                <th class="px-4 py-2 text-left border border-gray-300">Karbohidrat</th>
                <th class="px-4 py-2 text-left border border-gray-300">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menus as $menu)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 border border-gray-300">{{ $menu->nama_menu }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $menu->tanggal_menu }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $menu->nutrition->energi ?? '-' }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $menu->nutrition->protein ?? '-' }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $menu->nutrition->lemak ?? '-' }}</td>
                    <td class="px-4 py-2 border border-gray-300">{{ $menu->nutrition->karbohidrat ?? '-' }}</td>
                    <td>
                        <a href="{{ route('gizi.menus.edit', $menu->id) }}"
                            class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-2 py-1 rounded">
                            Edit
                        </a>

                        <form action="{{ route('gizi.menus.destroy', $menu->id) }}"
                                method="POST"
                                style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-block bg-red-600 hover:bg-red-700 text-white text-sm px-2 py-1 rounded"
                                    onclick="return confirm('Yakin ingin menghapus menu ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="px-4 py-2 text-center border border-gray-300">Belum ada data menu</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
