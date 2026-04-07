@extends('layouts.backend')

@section('content')
<div>
    <!-- Back Button -->
    <a href="{{ route('backend.pengaduan.index') }}" class="mb-6 inline-flex items-center text-sm font-semibold text-cyan-700 hover:text-cyan-900 transition-colors">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Kembali ke Daftar Pengaduan
    </a>

    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-3">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Detail Pengaduan</h1>
                <p class="text-sm text-slate-600 mt-1">Nomor Tiket: <span class="font-semibold text-slate-900">{{ $complaint->ticket_number }}</span></p>
            </div>
            <span class="inline-flex rounded-full px-4 py-2 text-sm font-semibold
                @switch($complaint->status)
                    @case('terkirim')
                        bg-red-100 text-red-700
                        @break
                    @case('dibaca')
                        @break
                    @case('diproses')
                        @break
                    @case('selesai')
                        @break
                @endswitch
            ">
                {{ ucfirst($complaint->status) }}
            </span>
        </div>
    </div>

    @if (session('success'))
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-800">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-800">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Complaint Details Card -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-slate-900">Informasi Pengaduan</h2>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-600">Kategori Pengaduan</p>
                        <p class="mt-2 text-sm font-semibold text-slate-900">{{ ucfirst(str_replace('-', ' ', $complaint->kategori)) }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-600">Tanggal Laporan</p>
                        <p class="mt-2 text-sm font-semibold text-slate-900">{{ $complaint->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-600 mb-2">Deskripsi Pengaduan</p>
                    <p class="text-sm text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $complaint->deskripsi }}</p>
                </div>

                @if($complaint->foto)
                <div class="mt-6">
                    <p class="text-xs font-semibold uppercase tracking-wide text-slate-600 mb-3">Foto Pengaduan</p>
                    <img src="{{ asset('storage/' . $complaint->foto) }}" alt="Foto Pengaduan" class="rounded-lg max-h-96 object-cover border border-slate-200">
                </div>
                @endif
            </div>

            <!-- Reporter Information Card -->
            <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-slate-900">Informasi Pelapor</h2>

                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-600">Nama Pelapor</p>
                        <p class="mt-2 text-sm font-semibold text-slate-900">{{ $complaint->nama_pelapor ?? 'Tidak Disebutkan (Anonim)' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-600">Kontak Pelapor</p>
                        <p class="mt-2 text-sm font-semibold text-slate-900">
                            @if($complaint->kontak_pelapor)
                                <a href="tel:{{ $complaint->kontak_pelapor }}" class="text-cyan-700 hover:underline">{{ $complaint->kontak_pelapor }}</a>
                            @else
                                Tidak Tersedia
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Follow-up Notes Card -->
            @if($complaint->catatan_tindak_lanjut)
            <div class="rounded-lg border border-amber-200 bg-amber-50 p-6 shadow-sm">
                <h2 class="mb-4 text-lg font-semibold text-amber-900">Catatan Tindak Lanjut</h2>
                <p class="text-sm text-amber-800 leading-relaxed whitespace-pre-wrap">{{ $complaint->catatan_tindak_lanjut }}</p>
            </div>
            @endif
        </div>

        <!-- Sidebar: Status Update Form -->
        <div class="lg:col-span-1">
            <form method="POST" action="{{ route('backend.pengaduan.update', $complaint) }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm sticky top-6">
                @csrf
                @method('PUT')

                <h2 class="mb-5 text-lg font-semibold text-slate-900">Ubah Status</h2>

                <!-- Status Selection -->
                <div class="mb-5">
                    <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">Pilih Status Baru</label>
                    <select name="status" id="status" class="w-full px-3 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent">
                        <option value="terkirim" @selected(old('status', $complaint->status) === 'terkirim')>
                            🔴 Terkirim
                        </option>
                        <option value="dibaca" @selected(old('status', $complaint->status) === 'dibaca')>
                            🟡 Dibaca
                        </option>
                        <option value="diproses" @selected(old('status', $complaint->status) === 'diproses')>
                            🔵 Diproses
                        </option>
                        <option value="selesai" @selected(old('status', $complaint->status) === 'selesai')>
                            🟢 Selesai
                        </option>
                    </select>
                </div>

                <!-- Follow-up Notes -->
                <div class="mb-5">
                    <label for="catatan_tindak_lanjut" class="block text-sm font-semibold text-slate-700 mb-2">Catatan Tindak Lanjut</label>
                    <textarea
                        name="catatan_tindak_lanjut"
                        id="catatan_tindak_lanjut"
                        rows="6"
                        placeholder="Tambahkan catatan atau penjelasan tentang tindakan yang telah atau akan dilakukan..."
                        class="w-full px-3 py-2.5 text-sm border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent resize-none"
                    >{{ old('catatan_tindak_lanjut', $complaint->catatan_tindak_lanjut) }}</textarea>
                    <p class="text-xs text-slate-600 mt-1">Berikan penjelasan singkat tentang tindак lanjut yang dilakukan</p>
                </div>

                <!-- Status Timeline Indicator -->
                <div class="mb-6 rounded-lg bg-slate-50 p-3">
                    <p class="text-xs font-semibold text-slate-700 mb-3 uppercase">Timeline Status</p>
                    <div class="space-y-2">
                        @foreach(['terkirim' => 'Terkirim', 'dibaca' => 'Dibaca', 'diproses' => 'Diproses', 'selesai' => 'Selesai'] as $status => $label)
                            @php
                                $isCompleted = in_array($complaint->status, ['dibaca', 'diproses', 'selesai']) && in_array($status, ['dibaca', 'diproses', 'selesai']) &&
                                    (($complaint->status === 'dibaca' && $status === 'dibaca') ||
                                        ($complaint->status === 'diproses' && in_array($status, ['dibaca', 'diproses'])) ||
                                        ($complaint->status === 'selesai'));
                                $isCurrent = $complaint->status === $status;
                            @endphp
                            <div class="flex items-center gap-2">
                                <div class="flex h-5 w-5 items-center justify-center rounded-full text-xs font-bold
                                    @if($isCurrent)
                                        bg-cyan-500 text-white
                                    @elseif($isCompleted || $complaint->status === 'terkirim')
                                    @else
                                    @endif
                                ">
                                    @if($isCompleted || $complaint->status === 'terkirim')
                                        ✓
                                    @else
                                        {{ $loop->index + 1 }}
                                    @endif
                                </div>
                                <span class="text-xs font-medium
                                    @if($isCurrent)
                                        text-cyan-700
                                    @elseif($isCompleted || $complaint->status === 'terkirim')
                                    @else
                                    @endif
                                ">
                                    {{ $label }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full inline-flex items-center justify-center rounded-lg bg-cyan-700 px-4 py-3 text-sm font-semibold text-white hover:bg-cyan-800 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
