<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SPPG')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900">
    <header class="border-b border-slate-200 bg-white">
        <nav class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('frontend.index') }}" class="text-xl font-bold text-cyan-700">SPPG Kokrosono</a>
            <ul class="flex flex-wrap gap-4 text-sm font-medium text-slate-700">
                <li><a href="{{ route('frontend.index') }}" class="hover:text-cyan-700">Menu Hari Ini</a></li>
                <li><a href="{{ route('frontend.riwayat-menu') }}" class="hover:text-cyan-700">Riwayat Menu</a></li>
                <li><a href="{{ route('frontend.tim') }}" class="hover:text-cyan-700">Tim SPPG</a></li>
                <li><a href="{{ route('frontend.pengaduan') }}" class="hover:text-cyan-700">Pengaduan</a></li>
                <li><a href="{{ route('login') }}" class="rounded-lg bg-cyan-700 px-3 py-1.5 text-white hover:bg-cyan-800">Login</a>
                </li>
            </ul>
        </nav>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-8 sm:px-6 lg:px-8">
        @yield('content')
    </main>
</body>

</html>
