<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPPG')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900">
    <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">
        <nav class="max-w-6xl px-4 py-4 mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <a href="{{ route('frontend.index') }}" class="text-xl font-bold text-cyan-700">SPPG Kokrosono</a>

                <button id="mobile-nav-trigger" type="button"
                    class="px-3 py-2 text-sm font-semibold border rounded-lg border-slate-200 text-slate-700 md:hidden">
                    Menu
                </button>

                <ul class="flex-wrap items-center hidden gap-4 text-sm font-medium text-slate-700 md:flex">
                    <li><a href="{{ route('frontend.index') }}" class="hover:text-cyan-700">Menu Hari Ini</a></li>
                    <li><a href="{{ route('frontend.riwayat-menu') }}" class="hover:text-cyan-700">Riwayat Menu</a></li>
                    <li><a href="{{ route('frontend.tim') }}" class="hover:text-cyan-700">Tim SPPG</a></li>
                    <li><a href="{{ route('frontend.pengaduan') }}" class="hover:text-cyan-700">Pengaduan</a></li>
                    <li><a href="{{ route('frontend.aduan-publik') }}" class="hover:text-cyan-700">Aduan Publik</a></li>
                    <li><a href="{{ route('frontend.cek-tiket') }}" class="hover:text-cyan-700">Cek Tiket</a></li>
                    <li><a href="{{ route('frontend.kontak-lokasi') }}" class="hover:text-cyan-700">Kontak & Lokasi</a></li>
                    <li><a href="{{ route('login') }}" class="rounded-lg bg-cyan-700 px-3 py-1.5 text-white hover:bg-cyan-800">Login</a></li>
                </ul>
            </div>

            <ul id="mobile-nav" class="hidden pt-4 mt-4 space-y-2 text-sm font-medium border-t border-slate-100 text-slate-700 md:hidden">
                <li><a href="{{ route('frontend.index') }}" class="block rounded-md px-2 py-1.5 hover:bg-slate-100">Menu Hari Ini</a></li>
                <li><a href="{{ route('frontend.riwayat-menu') }}" class="block rounded-md px-2 py-1.5 hover:bg-slate-100">Riwayat Menu</a></li>
                <li><a href="{{ route('frontend.tim') }}" class="block rounded-md px-2 py-1.5 hover:bg-slate-100">Tim SPPG</a></li>
                <li><a href="{{ route('frontend.pengaduan') }}" class="block rounded-md px-2 py-1.5 hover:bg-slate-100">Pengaduan</a></li>
                <li><a href="{{ route('frontend.aduan-publik') }}" class="block rounded-md px-2 py-1.5 hover:bg-slate-100">Aduan Publik</a></li>
                <li><a href="{{ route('frontend.cek-tiket') }}" class="block rounded-md px-2 py-1.5 hover:bg-slate-100">Cek Tiket</a></li>
                <li><a href="{{ route('frontend.kontak-lokasi') }}" class="block rounded-md px-2 py-1.5 hover:bg-slate-100">Kontak & Lokasi</a></li>
                <li><a href="{{ route('login') }}" class="mt-2 inline-flex rounded-lg bg-cyan-700 px-3 py-1.5 text-white hover:bg-cyan-800">Login</a></li>
            </ul>
        </nav>
    </header>

    <main class="max-w-6xl px-4 py-8 mx-auto sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <script>
        const mobileTrigger = document.getElementById('mobile-nav-trigger');
        const mobileNav = document.getElementById('mobile-nav');

        mobileTrigger?.addEventListener('click', () => {
            mobileNav?.classList.toggle('hidden');
        });
    </script>
</body>

</html>
