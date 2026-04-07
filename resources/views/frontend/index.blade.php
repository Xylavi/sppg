@extends('layouts.frontend')

@section('title', 'SPPG - Portal Menu, Gizi & Pengaduan Masyarakat')

@section('content')


<!-- HERO -->

<section id="hero" class="relative overflow-hidden rounded-3xl mb-20 bg-slate-950 px-8 py-16 md:px-16 md:py-24">

    <div class="pointer-events-none absolute -top-24 -left-24 w-96 h-96 rounded-full bg-cyan-500/20 blur-3xl"></div>
    <div class="pointer-events-none absolute -bottom-24 -right-24 w-96 h-96 rounded-full bg-sky-600/20 blur-3xl"></div>
    <div class="pointer-events-none absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-150 h-150 rounded-full bg-teal-500/5 blur-3xl"></div>

    <div class="relative z-10 max-w-3xl">
        <span class="inline-flex items-center gap-2 px-3 py-1.5 mb-6 rounded-full border border-white/10 bg-white/5 text-xs font-semibold tracking-widest uppercase text-cyan-300">
            <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
            Program MBG SPPG
        </span>

        <h1 class="text-4xl md:text-6xl font-extrabold leading-tight tracking-tight text-white">
            Menu Sehat,<br>
            <span class="text-transparent bg-clip-text bg-linear-to-r from-cyan-400 to-sky-300">Pelayanan Transparan</span>
        </h1>

        <p class="mt-6 text-base md:text-lg text-slate-400 max-w-xl leading-relaxed">
            Portal publik SPPG Kokrosono — informasi menu harian, gizi, profil tim, dan pengaduan masyarakat dalam satu tempat yang terbuka.
        </p>

        <div class="flex flex-wrap gap-3 mt-10">
            <a href="#menu"
                class="px-6 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-white text-sm font-semibold transition-all duration-200 shadow-lg shadow-cyan-500/25 hover:shadow-cyan-400/30 hover:-translate-y-0.5">
                Lihat Menu Hari Ini
            </a>
            <a href="#aduan-publik"
                class="px-6 py-3 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 text-white text-sm font-semibold transition-all duration-200 hover:-translate-y-0.5">
                Aduan Publik
            </a>
            <a href="#kontak"
                class="px-6 py-3 rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 text-white text-sm font-semibold transition-all duration-200 hover:-translate-y-0.5">
                Kontak
            </a>
        </div>
    </div>

    <div class="relative z-10 mt-14 flex flex-wrap gap-4">
        @php $stats = [['label'=>'Sekolah Binaan','value'=>'12+'],['label'=>'Menu Tersedia','value'=>$menusToday->count()],['label'=>'Anggota Tim','value'=>$teams->count()],['label'=>'Aduan Ditangani','value'=>$complaints->count()]] @endphp
        @foreach ($stats as $s)
        <div class="px-5 py-3 rounded-2xl border border-white/10 bg-white/5 backdrop-blur-sm">
            <p class="text-2xl font-bold text-white">{{ $s['value'] }}</p>
            <p class="text-xs text-slate-400 mt-0.5">{{ $s['label'] }}</p>
        </div>
        @endforeach
    </div>
</section>


<!-- MENU HARI INI -->

<section id="menu" class="mb-24 scroll-mt-8">

    <div class="flex items-end justify-between mb-10 gap-4 flex-wrap">
        <div>
            <p class="text-xs font-semibold tracking-widest uppercase text-cyan-600 mb-2">Menu Hari Ini</p>
            <h2 class="text-3xl font-bold tracking-tight text-slate-900">Sajian {{ now()->translatedFormat('l, d F Y') }}</h2>
            <p class="mt-2 text-slate-500">Menu gizi seimbang yang disiapkan untuk siswa hari ini.</p>
        </div>
        <a href="{{ route('frontend.riwayat-menu') }}" class="shrink-0 px-4 py-2 rounded-lg border border-slate-200 text-sm font-semibold text-slate-600 hover:border-cyan-400 hover:text-cyan-700 transition-colors">
            Lihat Semua Menu →
        </a>
    </div>

    @if ($menusToday->isEmpty())                
        <div class="flex flex-col items-center justify-center py-20 rounded-2xl border-2 border-dashed border-slate-200 text-slate-400 bg-slate-50">
            <svg class="w-12 h-12 mb-4 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2M12 2a10 10 0 1 0 0 20A10 10 0 0 0 12 2Z"/></svg>
            <p class="font-semibold">Belum ada menu untuk hari ini.</p>
            <p class="text-sm mt-1">Silakan cek kembali nanti.</p>
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($menusToday as $menu)
            <article class="group flex flex-col rounded-2xl overflow-hidden border border-slate-200 bg-white hover:border-cyan-300 hover:shadow-xl hover:shadow-cyan-500/10 transition-all duration-300">
                <div class="relative overflow-hidden h-48">
                    <img src="{{ asset('storage/' . $menu->foto_menu) }}"
                            alt="{{ $menu->nama_menu }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            onerror="this.src='https://placehold.co/800x450/e2f8f5/0e7490?text=Menu+SPPG'">
                    <div class="absolute inset-0 bg-linear-to-t from-black/40 to-transparent"></div>
                    <span class="absolute top-3 right-3 px-2.5 py-1 rounded-full bg-cyan-500 text-white text-xs font-bold">
                        {{ $menu->school?->nama_sekolah ?? 'Umum' }}
                    </span>
                </div>
                <div class="flex flex-col flex-1 p-5">
                    <h3 class="text-lg font-bold text-slate-900 mb-1">{{ $menu->nama_menu }}</h3>
                    <p class="text-xs text-slate-400 mb-4">{{ $menu->tanggal_menu->translatedFormat('d F Y') }}</p>
                    <div class="flex-1"></div>
                    <a href="{{ route('frontend.menu-detail', $menu) }}"
                        class="mt-4 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-slate-950 hover:bg-cyan-600 text-white text-sm font-semibold transition-colors duration-200">
                        Lihat Detail Gizi
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12l-7.5 7.5M3 12h18"/></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    @endif
</section>


<!-- TIM SPPG -->

<section id="tim" class="mb-24 scroll-mt-8">

    <div class="rounded-3xl bg-slate-950 px-8 py-14 md:px-14 relative overflow-hidden mb-12">
        <div class="pointer-events-none absolute -top-20 right-0 w-80 h-80 rounded-full bg-cyan-500/10 blur-3xl"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <p class="text-xs font-semibold tracking-widest uppercase text-cyan-400 mb-2">Staff SPPG</p>
                <h2 class="text-3xl font-bold text-white">Daftar Tim SPPG</h2>
                <p class="mt-2 text-slate-400 max-w-xl">Kenali para profesional yang bekerja di balik layanan gizi harian kami.</p>
            </div>
        </div>
    </div>

    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @forelse ($teams as $team)
        <article class="group flex items-center gap-4 p-5 bg-white border border-slate-200 rounded-2xl hover:border-cyan-300 hover:shadow-lg hover:shadow-cyan-500/10 transition-all duration-300">
            <div class="relative shrink-0">
                <img src="{{ asset('storage/' . $team->foto) }}"
                        alt="{{ $team->nama }}"
                        class="w-16 h-16 rounded-xl object-cover border-2 border-slate-100 group-hover:border-cyan-200 transition-colors"
                        onerror="this.src='https://placehold.co/200x200/e2f8f5/0e7490?text={{ urlencode(substr($team->nama,0,1)) }}'">
                <span class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full bg-emerald-400 border-2 border-white"></span>
            </div>
            <div class="min-w-0">
                <h3 class="font-bold text-slate-900 truncate">{{ $team->nama }}</h3>
                <p class="text-sm text-slate-500 mt-0.5">{{ $team->jabatan }}</p>
            </div>
        </article>
        @empty
        <p class="col-span-full py-10 text-center text-slate-400">Data tim belum tersedia.</p>
        @endforelse
    </div>
</section>


<!-- ADUAN PUBLIK -->

<section id="aduan-publik" class="mb-24 scroll-mt-8">

    <div class="flex items-end justify-between mb-10 gap-4 flex-wrap">
        <div>
            <p class="text-xs font-semibold tracking-widest uppercase text-cyan-600 mb-2">Transparansi Publik</p>
            <h2 class="text-3xl font-bold tracking-tight text-slate-900">Aduan Masyarakat</h2>
            <p class="mt-2 text-slate-500">Ditampilkan tanpa identitas pelapor demi menjaga privasi.</p>
        </div>
        <a href="{{ route('frontend.pengaduan') }}" class="shrink-0 px-5 py-2.5 rounded-xl bg-cyan-600 hover:bg-cyan-500 text-white text-sm font-semibold transition-colors shadow-md shadow-cyan-600/20">
            + Buat Aduan
        </a>
    </div>

    <div class="space-y-4">
        @forelse ($complaints as $complaint)
        <article class="flex gap-5 p-5 bg-white border border-slate-200 rounded-2xl hover:border-cyan-200 hover:shadow-md hover:shadow-cyan-500/5 transition-all duration-200">
            <div class="shrink-0 mt-0.5 w-10 h-10 rounded-xl bg-amber-50 border border-amber-200 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                </svg>
            </div>
            <div class="flex-1 min-w-0">
                <div class="flex flex-wrap items-center gap-2 mb-2">
                    <span class="px-2.5 py-0.5 rounded-full bg-slate-100 text-slate-700 text-xs font-semibold">
                        {{ ucfirst(str_replace('-', ' ', $complaint->kategori)) }}
                    </span>
                    <span class="text-xs text-slate-400">{{ $complaint->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                </div>
                <p class="text-sm text-slate-700 leading-relaxed">{{ $complaint->deskripsi }}</p>
            </div>
        </article>
        @empty
        <div class="flex flex-col items-center justify-center py-20 rounded-2xl border-2 border-dashed border-slate-200 text-slate-400 bg-slate-50">
            <svg class="w-10 h-10 mb-3 opacity-40" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
            <p class="font-semibold">Belum ada aduan publik.</p>
        </div>
        @endforelse
    </div>
</section>


<!-- KONTAK & LOKASI -->

<section id="kontak" class="mb-24 scroll-mt-8">

    <div class="rounded-3xl bg-slate-950 px-8 py-14 md:px-14 relative overflow-hidden mb-12">
        <div class="pointer-events-none absolute -bottom-20 left-0 w-80 h-80 rounded-full bg-sky-500/10 blur-3xl"></div>
        <div class="relative z-10">
            <p class="text-xs font-semibold tracking-widest uppercase text-cyan-400 mb-2">Pusat Informasi</p>
            <h2 class="text-3xl font-bold text-white">Kontak & Lokasi</h2>
            <p class="mt-2 text-slate-400 max-w-xl">Hubungi kami untuk informasi operasional, kendala layanan, atau koordinasi dengan pihak sekolah.</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">

        <!-- Contact card -->
        <div class="flex flex-col gap-4">
            <article class="p-6 bg-white border border-slate-200 rounded-2xl flex-1">
                <h3 class="font-bold text-slate-900 mb-4">Kontak Utama</h3>
                <ul class="space-y-3.5">
                    @php
                        $contacts = [
                            ['icon'=>'phone','label'=>'Telepon','value'=>'(024) 7654 1234'],
                            ['icon'=>'whatsapp','label'=>'WhatsApp','value'=>'+62 812 0000 1234'],
                            ['icon'=>'email','label'=>'Email','value'=>'sppg.kokrosono@example.id'],
                            ['icon'=>'clock','label'=>'Jam Layanan','value'=>'Senin–Jumat, 07.00–16.00'],
                        ];
                    @endphp
                    @foreach ($contacts as $c)
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 w-8 h-8 rounded-lg bg-cyan-50 border border-cyan-100 flex items-center justify-center shrink-0">
                            @if($c['icon'] === 'phone')
                                <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                            @elseif($c['icon'] === 'whatsapp')
                                <svg class="w-4 h-4 text-cyan-600" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            @elseif($c['icon'] === 'email')
                                <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                            @else
                                <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 2m6-2a10 10 0 1 1-20 0 10 10 0 0 1 20 0Z"/></svg>
                            @endif
                        </span>
                        <div>
                            <p class="text-xs text-slate-400">{{ $c['label'] }}</p>
                            <p class="text-sm font-medium text-slate-800">{{ $c['value'] }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>

                <a href="{{ 404 }}"
                    class="mt-6 flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-xl bg-slate-950 hover:bg-cyan-600 text-white text-sm font-semibold transition-colors duration-200">
                    Hubungi Kami
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12l-7.5 7.5M3 12h18"/></svg>
                </a>
            </article>
        </div>

        <!-- Gmaps card -->
        <article class="p-6 bg-white border border-slate-200 rounded-2xl lg:col-span-2">
            <div class="flex items-center gap-3 mb-4">
                <span class="w-8 h-8 rounded-lg bg-cyan-50 border border-cyan-100 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                </span>
                <div>
                    <h3 class="font-bold text-slate-900 leading-tight">Lokasi Satuan Layanan</h3>
                    <p class="text-xs text-slate-500">Jl. Kokrosono No. 10, Semarang, Jawa Tengah</p>
                </div>
            </div>
            <div class="overflow-hidden rounded-xl border border-slate-200">
                <iframe title="Lokasi SPPG Kokrosono"
                        class="w-full h-72 md:h-80"
                        src="https://maps.google.com/maps?q=Kokrosono%20Semarang&t=&z=14&ie=UTF8&iwloc=&output=embed"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </article>
    </div>
</section>


<!-- FOOTER -->

<footer class="border-t border-slate-200 pt-10 pb-6 mb-4">
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 text-sm text-slate-400">
        <p>© {{ date('Y') }} SPPG Kokrosono — Oxy Laviosa</p>
        <div class="flex gap-6">
            <a href="#menu" class="hover:text-cyan-600 transition-colors">Menu</a>
            <a href="#tim" class="hover:text-cyan-600 transition-colors">Tim</a>
            <a href="#aduan-publik" class="hover:text-cyan-600 transition-colors">Aduan</a>
            <a href="#kontak" class="hover:text-cyan-600 transition-colors">Kontak</a>
        </div>
    </div>
</footer>


<!---- SCRIPT ---->

<script>
    const form = document.getElementById('complaint-form');
    if (form) {
        const isAnonimInput  = document.getElementById('is-anonim');
        const identityFields = document.getElementById('identity-fields');
        const namaInput      = document.getElementById('nama');
        const kontakInput    = document.getElementById('kontak');
        const kategoriInput  = document.getElementById('kategori');
        const deskripsiInput = document.getElementById('deskripsi');
        const fotoInput      = document.getElementById('foto');
        const formError      = document.getElementById('form-error');

        const toggleIdentityFields = () => {
            const anonim = isAnonimInput.checked;
            identityFields.classList.toggle('hidden', anonim);
            namaInput.toggleAttribute('required', !anonim);
            kontakInput.toggleAttribute('required', !anonim);
        };

        const validateFile = (file) => {
            if (!file) return null;
            if (!['image/jpeg','image/png'].includes(file.type)) return 'Lampiran harus berupa JPG atau PNG.';
            if (file.size > 2 * 1024 * 1024) return 'Ukuran lampiran maksimal 2MB.';
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
    }
</script>

@endsection
