@extends('layouts.frontend')

@section('title', 'SPPG - Portal Menu, Gizi, dan Pengaduan Masyarakat')

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="p-6 mb-12 text-white rounded-2xl bg-linear-to-r from-cyan-700 to-sky-600 md:p-8">
        <p class="inline-flex px-3 py-1 mb-2 text-xs font-semibold tracking-wide rounded-full bg-white/20">Program MBG SPPG</p>
        <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Menu Hari Ini & Layanan Publik</h1>
        <p class="max-w-2xl mt-2 text-cyan-50">Informasi menu, gizi, dan layanan pengaduan masyarakat dalam satu portal publik yang transparan. Kami berkomitmen untuk memberikan pelayanan terbaik.</p>
        <div class="flex flex-wrap gap-3 mt-6">
            <a href="#tim" class="px-4 py-2 text-sm font-semibold text-white border rounded-lg border-white/40 hover:bg-white/10">Tim Kami</a>
            <a href="#aduan-publik" class="px-4 py-2 text-sm font-semibold text-white border rounded-lg border-white/40 hover:bg-white/10">Lihat Aduan Publik</a>
            <a href="#kontak" class="px-4 py-2 text-sm font-semibold text-white border rounded-lg border-white/40 hover:bg-white/10">Kontak & Lokasi</a>
        </div>
    </section>

    <!-- Menu Hari Ini Section -->
    <section id="menu" class="mb-16">
        <div class="mb-8">
            <h2 class="text-2xl font-bold tracking-tight">Menu Hari Ini</h2>
            <p class="mt-2 text-slate-600">Lihat menu pelayanan makan yang tersedia untuk hari ini.</p>
        </div>

        @if ($menusToday->isEmpty())
            <div class="p-8 text-center bg-white border border-dashed rounded-xl border-slate-300 text-slate-500">
                Belum ada menu yang dijadwalkan untuk hari ini.
            </div>
        @else
            <section class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($menusToday as $menu)
                    <article class="overflow-hidden bg-white border shadow-sm rounded-xl border-slate-200 hover:shadow-lg transition-shadow">
                        <img src="{{ $menu->foto_menu }}" alt="{{ $menu->nama_menu }}" class="object-cover w-full h-44"
                            onerror="this.src='https://placehold.co/800x450?text=Foto+Menu'">
                        <div class="p-4 space-y-2">
                            <h3 class="text-lg font-semibold">{{ $menu->nama_menu }}</h3>
                            <p class="text-sm text-slate-600">{{ $menu->tanggal_menu->translatedFormat('d F Y') }}</p>
                            <p class="text-sm text-slate-600">{{ $menu->school?->nama_sekolah ?? '-' }}</p>
                            <a href="{{ route('frontend.menu-detail', $menu) }}"
                                class="inline-flex px-4 py-2 mt-2 text-sm font-semibold text-white rounded-lg bg-cyan-700 hover:bg-cyan-800">Lihat
                                Detail Gizi</a>
                        </div>
                    </article>
                @endforeach
            </section>
        @endif
    </section>

    <!-- Tim Section -->
    <section id="tim" class="mb-16">
        <div class="p-6 mb-8 text-white rounded-2xl bg-linear-to-r from-cyan-700 to-sky-600 md:p-8">
            <p class="inline-flex px-3 py-1 mb-2 text-xs font-semibold tracking-wide rounded-full bg-white/20">Staff SPPG</p>
            <h2 class="text-3xl font-bold tracking-tight md:text-4xl">Daftar Tim SPPG</h2>
            <p class="max-w-2xl mt-2 text-cyan-50">Informasi anggota tim yang bertugas di satuan layanan SPPG.</p>
        </div>

        <section class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($teams as $team)
                <article class="p-4 text-center bg-white border shadow-sm rounded-xl border-slate-200 hover:shadow-lg transition-shadow">
                    <img src="{{ $team->foto }}" alt="{{ $team->nama }}"
                        class="object-cover mx-auto mb-4 rounded-full h-28 w-28"
                        onerror="this.src='https://placehold.co/300x300?text=Foto+Tim'">
                    <h3 class="text-lg font-semibold">{{ $team->nama }}</h3>
                    <p class="text-sm text-slate-600">{{ $team->jabatan }}</p>
                </article>
            @empty
                <p class="col-span-full text-slate-500">Data tim belum tersedia.</p>
            @endforelse
        </section>
    </section>

    <!-- Aduan Publik Section -->
    <section id="aduan-publik" class="mb-16">
        <div class="mb-8">
            <h2 class="text-2xl font-bold tracking-tight">Daftar Aduan Publik</h2>
            <p class="mt-2 text-slate-600">Daftar pengaduan masyarakat tanpa menampilkan identitas pelapor.</p>
        </div>

        <section class="space-y-4">
            @forelse ($complaints as $complaint)
                <article class="p-5 bg-white border shadow-sm rounded-xl border-slate-200 hover:shadow-lg transition-shadow">
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900">{{ ucfirst(str_replace('-', ' ', $complaint->kategori)) }}</h3>
                        </div>
                    </div>

                    <p class="mt-3 text-sm text-slate-700">{{ $complaint->deskripsi }}</p>
                    <p class="mt-2 text-xs text-slate-500">Dikirim {{ $complaint->created_at->translatedFormat('d F Y H:i') }}</p>
                </article>
            @empty
                <p class="p-6 text-sm bg-white border border-dashed rounded-lg border-slate-300 text-slate-500">Belum ada data aduan publik.</p>
            @endforelse
        </section>
    </section>

    <!-- Kontak & Lokasi Section -->
    <section id="kontak" class="mb-16">
        <div class="p-6 mb-8 text-white rounded-2xl bg-linear-to-r from-cyan-700 to-sky-600 md:p-8">
            <p class="inline-flex px-3 py-1 mb-2 text-xs font-semibold tracking-wide rounded-full bg-white/20">Pusat Informasi SPPG</p>
            <h2 class="text-3xl font-bold tracking-tight md:text-4xl">Kontak & Lokasi Layanan</h2>
            <p class="max-w-2xl mt-2 text-cyan-50">Silakan hubungi kami untuk informasi operasional MBG, pelaporan kendala, maupun koordinasi dengan pihak sekolah.</p>
        </div>

        <section class="grid gap-6 lg:grid-cols-3">
            <article class="p-5 bg-white border shadow-sm rounded-xl border-slate-200">
                <h3 class="text-lg font-semibold">Kontak Utama</h3>
                <ul class="mt-3 space-y-2 text-sm text-slate-600">
                    <li><span class="font-semibold text-slate-800">Telepon:</span> (024) 7654 1234</li>
                    <li><span class="font-semibold text-slate-800">WhatsApp:</span> +62 812 0000 1234</li>
                    <li><span class="font-semibold text-slate-800">Email:</span> sppg.kokrosono@example.id</li>
                    <li><span class="font-semibold text-slate-800">Jam Layanan:</span> Senin–Jumat, 07.00–16.00</li>
                </ul>
                <a href="#pengaduan" class="inline-flex px-4 py-2 mt-4 text-sm font-semibold text-white rounded-lg bg-cyan-700 hover:bg-cyan-800">Buat Pengaduan</a>
            </article>

            <article class="p-5 bg-white border shadow-sm rounded-xl border-slate-200 lg:col-span-2">
                <h3 class="text-lg font-semibold">Lokasi Satuan Layanan</h3>
                <p class="mt-2 text-sm text-slate-600">Jl. Kokrosono No. 10, Semarang, Jawa Tengah.</p>

                <div class="mt-4 overflow-hidden border rounded-lg border-slate-200">
                    <iframe title="Lokasi SPPG Kokrosono" class="w-full h-72 md:h-96"
                        src="https://maps.google.com/maps?q=Kokrosono%20Semarang&t=&z=14&ie=UTF8&iwloc=&output=embed" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </article>
        </section>
    </section>

    <script>
        const form = document.getElementById('complaint-form');
        const isAnonimInput = document.getElementById('is-anonim');
        const identityFields = document.getElementById('identity-fields');
        const namaInput = document.getElementById('nama');
        const kontakInput = document.getElementById('kontak');
        const kategoriInput = document.getElementById('kategori');
        const deskripsiInput = document.getElementById('deskripsi');
        const fotoInput = document.getElementById('foto');
        const formError = document.getElementById('form-error');

        const toggleIdentityFields = () => {
            const anonim = isAnonimInput.checked;
            identityFields.classList.toggle('hidden', anonim);
            namaInput.toggleAttribute('required', !anonim);
            kontakInput.toggleAttribute('required', !anonim);
        };

        const validateFile = (file) => {
            if (!file) {
                return null;
            }

            const allowed = ['image/jpeg', 'image/png'];
            if (!allowed.includes(file.type)) {
                return 'Lampiran harus berupa JPG atau PNG.';
            }

            if (file.size > 2 * 1024 * 1024) {
                return 'Ukuran lampiran maksimal 2MB.';
            }

            return null;
        };

        isAnonimInput.addEventListener('change', toggleIdentityFields);
        toggleIdentityFields();

        form.addEventListener('submit', (event) => {
            formError.classList.add('hidden');

            if (!kategoriInput.value || !deskripsiInput.value.trim()) {
                event.preventDefault();
                formError.textContent = 'Kategori dan deskripsi wajib diisi.';
                formError.classList.remove('hidden');
                return;
            }

            if (!isAnonimInput.checked && (!namaInput.value.trim() || !kontakInput.value.trim())) {
                event.preventDefault();
                formError.textContent = 'Nama dan kontak wajib diisi jika tidak anonim.';
                formError.classList.remove('hidden');
                return;
            }

            const fileError = validateFile(fotoInput.files[0]);
            if (fileError) {
                event.preventDefault();
                formError.textContent = fileError;
                formError.classList.remove('hidden');
            }
        });
    </script>
@endsection
