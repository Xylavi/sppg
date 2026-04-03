@extends('layouts.frontend')

@section('title', 'SPPG | Form Pengaduan')

@section('content')
    <section class="p-6 mb-8 text-white rounded-2xl bg-gradient-to-r from-cyan-700 to-sky-600 md:p-8">
        <p class="inline-flex px-3 py-1 mb-2 text-xs font-semibold tracking-wide rounded-full bg-white/20">Layanan Publik SPPG</p>
        <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Sampaikan Pengaduan Anda</h1>
        <p class="max-w-2xl mt-2 text-cyan-50">Kami menindaklanjuti setiap laporan secara bertahap. Isi formulir berikut secara anonim
            atau beridentitas untuk membantu peningkatan kualitas layanan MBG.</p>
    </section>

    @if (session('success_ticket'))
        <div class="p-4 mb-6 border rounded-lg border-emerald-200 bg-emerald-50 text-emerald-800">
            <p class="text-sm">Pengaduan berhasil dikirim.</p>
            <p class="text-lg font-bold">Nomor Tiket: {{ session('success_ticket') }}</p>
            <a href="{{ route('frontend.cek-tiket', ['ticket' => session('success_ticket')]) }}" class="inline-flex mt-2 text-sm font-semibold underline text-emerald-800">Lacak status tiket ini</a>
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-6 text-sm border rounded-lg border-rose-200 bg-rose-50 text-rose-700">
            <ul class="pl-5 list-disc">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="grid gap-6 lg:grid-cols-3">
        <article class="p-5 bg-white border shadow-sm rounded-xl border-slate-200 lg:col-span-1">
            <h2 class="text-lg font-semibold">Alur Tindak Lanjut</h2>
            <ol class="mt-3 space-y-2 text-sm text-slate-600">
                <li><span class="font-semibold text-slate-800">1.</span> Laporan terkirim dan mendapat nomor tiket.</li>
                <li><span class="font-semibold text-slate-800">2.</span> Petugas membaca dan memverifikasi laporan.</li>
                <li><span class="font-semibold text-slate-800">3.</span> Status diperbarui: diproses hingga selesai.</li>
            </ol>
        </article>

        <article class="p-5 bg-white border shadow-sm rounded-xl border-slate-200 lg:col-span-2">
            <form id="complaint-form" class="space-y-4" method="POST" action="{{ route('frontend.pengaduan.store') }}"
                enctype="multipart/form-data" novalidate>
                @csrf
                <div class="grid gap-4 md:grid-cols-2">
                    <label class="text-sm font-medium text-slate-700">Kategori Pengaduan
                        <select id="kategori" name="kategori" required class="w-full px-3 py-2 mt-1 border rounded-lg border-slate-300">
                            <option value="">Pilih kategori</option>
                            <option value="kualitas-makanan" @selected(old('kategori') === 'kualitas-makanan')>Kualitas Makanan</option>
                            <option value="kebersihan" @selected(old('kategori') === 'kebersihan')>Kebersihan</option>
                            <option value="distribusi" @selected(old('kategori') === 'distribusi')>Distribusi</option>
                            <option value="lainnya" @selected(old('kategori') === 'lainnya')>Lainnya</option>
                        </select>
                    </label>

                    <label class="flex items-end gap-2 px-3 py-2 text-sm border rounded-lg border-slate-200 text-slate-700">
                        <input id="is-anonim" name="is_anonim" type="checkbox" value="1"
                            class="w-4 h-4 rounded border-slate-300 text-cyan-700" @checked(old('is_anonim'))>
                        Kirim sebagai anonim
                    </label>
                </div>

                <div id="identity-fields" class="grid gap-4 md:grid-cols-2">
                    <label class="text-sm font-medium text-slate-700">Nama Pelapor
                        <input id="nama" name="nama_pelapor" type="text"
                            class="w-full px-3 py-2 mt-1 border rounded-lg border-slate-300" placeholder="Nama lengkap"
                            value="{{ old('nama_pelapor') }}">
                    </label>
                    <label class="text-sm font-medium text-slate-700">Kontak Pelapor
                        <input id="kontak" name="kontak_pelapor" type="text"
                            class="w-full px-3 py-2 mt-1 border rounded-lg border-slate-300" placeholder="No. HP / Email"
                            value="{{ old('kontak_pelapor') }}">
                    </label>
                </div>

                <label class="block text-sm font-medium text-slate-700">Deskripsi Pengaduan
                    <textarea id="deskripsi" name="deskripsi" rows="5" required class="w-full px-3 py-2 mt-1 border rounded-lg border-slate-300"
                        placeholder="Jelaskan masalah secara singkat, jelas, dan faktual.">{{ old('deskripsi') }}</textarea>
                </label>

                <label class="block text-sm font-medium text-slate-700">Lampiran Foto (JPG/PNG, maks 2MB)
                    <input id="foto" name="foto" type="file" accept="image/png,image/jpeg"
                        class="block w-full px-3 py-2 mt-1 text-sm border rounded-lg border-slate-300 file:mr-4 file:rounded-md file:border-0 file:bg-cyan-700 file:px-3 file:py-2 file:text-white">
                </label>

                <p id="form-error" class="hidden px-3 py-2 text-sm rounded-lg bg-rose-50 text-rose-700"></p>

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
