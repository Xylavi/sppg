@extends('layouts.backend')

@section('content')
<div>
    <div class="mb-6">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">Tambah Menu Baru</h1>
        <p class="text-sm text-slate-600">Tambahkan menu makanan dan data gizi</p>
    </div>

    <div class="mx-auto max-w-2xl">
        <form action="{{ route('gizi.menus.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6 rounded-lg border border-slate-200 bg-white p-8 shadow-sm">
            @csrf

            <!-- Nama Menu -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Menu</label>
                <input type="text" name="nama_menu" value="{{ old('nama_menu') }}" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="Contoh: Nasi Putih dengan Ikan & Sayuran" required>
                @error('nama_menu')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Menu -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Menu</label>
                <input type="date" name="tanggal_menu" value="{{ old('tanggal_menu', $today) }}" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" required>
                @error('tanggal_menu')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sekolah Penerima -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Sekolah Penerima</label>
                <select name="school_id" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" required>
                    <option value="">-- Pilih Sekolah --</option>
                    @foreach ($schools as $school)
                    <option value="{{ $school->id }}" @selected(old('school_id') == $school->id)>{{ $school->nama_sekolah }}</option>
                    @endforeach
                </select>
                @error('school_id')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jumlah Porsi -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Porsi</label>
                <input type="number" name="porsi" value="{{ old('porsi') }}" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="0" min="1" required>
                @error('porsi')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Foto Menu -->
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Foto Menu <span class="text-red-600">*</span></label>
                <div class="flex items-center justify-center w-full">
                    <label for="foto_menu" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-slate-300 rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100">
                        <div id="foto_display" class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 text-slate-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            <p class="text-sm text-slate-600"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                            <p class="text-xs text-slate-500">PNG, JPG, GIF max 2MB</p>
                        </div>
                        <input id="foto_menu" type="file" name="foto_menu" class="hidden" accept="image/png,image/jpeg">
                    </label>
                </div>
                @error('foto_menu')
                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nutrition Data Section -->
            <div class="pt-4 border-t border-slate-200">
                <h3 class="text-lg font-semibold text-slate-900 mb-4">Data Nutrisi</h3>

                <div class="grid gap-4 md:grid-cols-2">
                    <!-- Energi -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Energi (kkal)</label>
                        <input type="number" name="energi" value="{{ old('energi') }}" step="0.1" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="0" required>
                        @error('energi')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Protein -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Protein (gram)</label>
                        <input type="number" name="protein" value="{{ old('protein') }}" step="0.1" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="0" required>
                        @error('protein')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lemak -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Lemak (gram)</label>
                        <input type="number" name="lemak" value="{{ old('lemak') }}" step="0.1" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="0" required>
                        @error('lemak')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Karbohidrat -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Karbohidrat (gram)</label>
                        <input type="number" name="karbohidrat" value="{{ old('karbohidrat') }}" step="0.1" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm placeholder-slate-400 focus:border-cyan-700 focus:outline-none focus:ring-1 focus:ring-cyan-700" placeholder="0" required>
                        @error('karbohidrat')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3 pt-4">
                <button type="submit" class="rounded-lg bg-cyan-700 px-6 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">
                    Simpan Menu
                </button>

                <a href="{{ route('gizi.dashboard') }}" class="rounded-lg border border-slate-300 px-6 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    // File upload preview with proper event listener handling
    function attachFileChangeListener() {
        const fileInput = document.getElementById('foto_menu');
        if (!fileInput) return;

        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const fileName = this.files[0].name;
                const displayArea = document.getElementById('foto_display');

                if (displayArea) {
                    displayArea.innerHTML = `
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 text-green-500 mb-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-sm text-green-600"><span class="font-semibold">${fileName}</span></p>
                            <p class="text-xs text-green-500">Klik untuk mengganti file</p>
                        </div>
                    `;
                }
            }
        });
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        attachFileChangeListener();
    });
</script>
@endsection
