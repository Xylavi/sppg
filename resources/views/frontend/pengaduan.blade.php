@extends('layouts.frontend')

@section('title', 'SPPG | Form Pengaduan')

@section('content')
    <section class="mb-8 rounded-2xl bg-gradient-to-r from-cyan-700 to-sky-600 p-6 text-white md:p-8">
        <p class="mb-2 inline-flex rounded-full bg-white/20 px-3 py-1 text-xs font-semibold tracking-wide">Layanan Publik SPPG</p>
        <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Sampaikan Pengaduan Anda</h1>
        <p class="mt-2 max-w-2xl text-cyan-50">Kami menindaklanjuti setiap laporan secara bertahap. Isi formulir berikut secara anonim
            atau beridentitas untuk membantu peningkatan kualitas layanan MBG.</p>
    </section>

    @if (session('success_ticket'))
        <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
            <p class="text-sm">Pengaduan berhasil dikirim.</p>
            <p class="text-lg font-bold">Nomor Tiket: {{ session('success_ticket') }}</p>
            <a href="{{ route('frontend.cek-tiket', ['ticket' => session('success_ticket')]) }}" class="mt-2 inline-flex text-sm font-semibold text-emerald-800 underline">Lacak status tiket ini</a>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="grid gap-6 lg:grid-cols-3">
        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-1">
            <h2 class="text-lg font-semibold">Alur Tindak Lanjut</h2>
            <ol class="mt-3 space-y-2 text-sm text-slate-600">
                <li><span class="font-semibold text-slate-800">1.</span> Laporan terkirim dan mendapat nomor tiket.</li>
                <li><span class="font-semibold text-slate-800">2.</span> Petugas membaca dan memverifikasi laporan.</li>
                <li><span class="font-semibold text-slate-800">3.</span> Status diperbarui: diproses hingga selesai.</li>
            </ol>
        </article>

        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2">
            <form id="complaint-form" class="space-y-4" method="POST" action="{{ route('frontend.pengaduan.store') }}"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="grid gap-4 md:grid-cols-2">
                    <label class="text-sm font-medium text-slate-700">Kategori Pengaduan
                        <select id="kategori" name="kategori" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2">
                            <option value="">Pilih kategori</option>
                            <option value="kualitas-makanan" @selected(old('kategori') === 'kualitas-makanan')>Kualitas Makanan</option>
                            <option value="kebersihan" @selected(old('kategori') === 'kebersihan')>Kebersihan</option>
                            <option value="distribusi" @selected(old('kategori') === 'distribusi')>Distribusi</option>
                            <option value="lainnya" @selected(old('kategori') === 'lainnya')>Lainnya</option>
                        </select>
                    </label>

                    <label class="flex items-end gap-2 rounded-lg border border-slate-200 px-3 py-2 text-sm text-slate-700">
                        <input id="is-anonim" name="is_anonim" type="checkbox" value="1"
                            class="h-4 w-4 rounded border-slate-300 text-cyan-700" @checked(old('is_anonim'))>
                        Kirim sebagai anonim
                    </label>
                </div>

                <div id="identity-fields" class="grid gap-4 md:grid-cols-2">
                    <label class="text-sm font-medium text-slate-700">Nama Pelapor
                        <input id="nama" name="nama_pelapor" type="text"
                            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2" placeholder="Nama lengkap"
                            value="{{ old('nama_pelapor') }}">
                    </label>
                    <label class="text-sm font-medium text-slate-700">Kontak Pelapor
                        <input id="kontak" name="kontak_pelapor" type="text"
                            class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2" placeholder="No. HP / Email"
                            value="{{ old('kontak_pelapor') }}">
                    </label>
                </div>

                <label class="block text-sm font-medium text-slate-700">Deskripsi Pengaduan
                    <textarea id="deskripsi" name="deskripsi" rows="5" required class="mt-1 w-full rounded-lg border border-slate-300 px-3 py-2"
                        placeholder="Jelaskan masalah secara singkat, jelas, dan faktual.">{{ old('deskripsi') }}</textarea>
                </label>

                <label class="block text-sm font-medium text-slate-700">Lampiran Foto (JPG/PNG, maks 2MB)
                    <input id="foto" name="foto" type="file" accept="image/png,image/jpeg"
                        class="mt-1 block w-full rounded-lg border border-slate-300 px-3 py-2 text-sm file:mr-4 file:rounded-md file:border-0 file:bg-cyan-700 file:px-3 file:py-2 file:text-white">
                </label>

                <p id="form-error" class="hidden rounded-lg bg-rose-50 px-3 py-2 text-sm text-rose-700"></p>

                <button type="submit"
                    class="inline-flex rounded-lg bg-cyan-700 px-5 py-2.5 text-sm font-semibold text-white hover:bg-cyan-800">Kirim
                    Pengaduan</button>
            </form>
        </article>
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
