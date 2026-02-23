@extends('layouts.frontend')

@section('title', 'SPPG | Kontak & Lokasi')

@section('content')
    <section class="mb-8 rounded-2xl bg-gradient-to-r from-cyan-700 to-sky-600 p-6 text-white md:p-8">
        <p class="mb-2 inline-flex rounded-full bg-white/20 px-3 py-1 text-xs font-semibold tracking-wide">Pusat Informasi SPPG</p>
        <h1 class="text-3xl font-bold tracking-tight md:text-4xl">Kontak & Lokasi Layanan</h1>
        <p class="mt-2 max-w-2xl text-cyan-50">Silakan hubungi kami untuk informasi operasional MBG, pelaporan kendala, maupun koordinasi dengan pihak sekolah.</p>
    </section>

    <section class="grid gap-6 lg:grid-cols-3">
        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-lg font-semibold">Kontak Utama</h2>
            <ul class="mt-3 space-y-2 text-sm text-slate-600">
                <li><span class="font-semibold text-slate-800">Telepon:</span> (024) 7654 1234</li>
                <li><span class="font-semibold text-slate-800">WhatsApp:</span> +62 812 0000 1234</li>
                <li><span class="font-semibold text-slate-800">Email:</span> sppg.kokrosono@example.id</li>
                <li><span class="font-semibold text-slate-800">Jam Layanan:</span> Senin–Jumat, 07.00–16.00</li>
            </ul>
            <a href="{{ route('frontend.pengaduan') }}" class="mt-4 inline-flex rounded-lg bg-cyan-700 px-4 py-2 text-sm font-semibold text-white hover:bg-cyan-800">Buat Pengaduan</a>
        </article>

        <article class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm lg:col-span-2">
            <h2 class="text-lg font-semibold">Lokasi Satuan Layanan</h2>
            <p class="mt-2 text-sm text-slate-600">Jl. Kokrosono No. 10, Semarang, Jawa Tengah.</p>

            <div class="mt-4 overflow-hidden rounded-lg border border-slate-200">
                <iframe title="Lokasi SPPG Kokrosono" class="h-72 w-full md:h-96"
                    src="https://maps.google.com/maps?q=Kokrosono%20Semarang&t=&z=14&ie=UTF8&iwloc=&output=embed" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </article>
    </section>
@endsection
