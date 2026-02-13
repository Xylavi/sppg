@extends('layouts.backend')

@section('content')

<div class="max-w-3xl mx-auto mt-6">
    <h2 class="mb-4 text-2xl font-bold">Tambah Menu</h2>

    <form action="{{ route('gizi.menus.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-semibold">Nama Menu</label>
            <input type="text" name="nama_menu"
                    class="w-full px-3 py-2 border rounded"
                    required>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Tanggal Menu</label>
            <input type="date" name="tanggal_menu"
                    class="w-full px-3 py-2 border rounded"
                    required>
        </div>

        <hr class="my-4">

        <h4 class="text-lg font-semibold">Informasi Nutrisi</h4>

        <div>
            <label class="block mb-1">Energi</label>
            <input type="number" name="energi"
                    class="w-full px-3 py-2 border rounded">
        </div>

        <div>
            <label class="block mb-1">Protein</label>
            <input type="number" name="protein"
                    class="w-full px-3 py-2 border rounded">
        </div>

        <div>
            <label class="block mb-1">Lemak</label>
            <input type="number" name="lemak"
                    class="w-full px-3 py-2 border rounded">
        </div>

        <div>
            <label class="block mb-1">Karbohidrat</label>
            <input type="number" name="karbohidrat"
                    class="w-full px-3 py-2 border rounded">
        </div>

        <button type="submit"
                class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Simpan
        </button>

    </form>
</div>

@endsection
