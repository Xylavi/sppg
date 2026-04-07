<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backend - SPPG</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 border-r border-slate-200 bg-white">
            <div class="p-6 border-b border-slate-200">
                <h2 class="text-lg font-bold text-cyan-700">Dashboard SPPG</h2>
            </div>

            <nav class="space-y-1 p-4">
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.users.index') }}"
                    class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
                    Manajemen User
                </a>

                <a href="{{ route('admin.schools.index') }}"
                    class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
                    Data Sekolah MBG
                </a>

                <a href="{{ route('admin.menus.index') }}"
                    class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
                    Monitor Menu & Gizi
                </a>

                <a href="{{ route('admin.complaints.index') }}"
                    class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
                    Monitor Pengaduan
                </a>
                @endif

                @if(auth()->user()->role === 'petugas_gizi')
                <a href="{{ route('gizi.dashboard') }}"
                    class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
                    Kelola Data Gizi
                </a>

                <a href="{{ route('gizi.menus.history') }}"
                    class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
                    Riwayat Menu
                </a>

                <a href="{{ route('gizi.porsi-recap') }}"
                    class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
                    Rekap Porsi
                </a>
                @endif

                @if(auth()->user()->role === 'petugas_pengaduan')
                <a href="{{ route('backend.pengaduan.dashboard') }}"
                    class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
                    Dashboard Pengaduan
                </a>
                <a href="{{ route('backend.pengaduan.index') }}"
                    class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-100">
                    Kelola Pengaduan
                </a>
                @endif

                <a href="/logout"
                    class="mt-6 block rounded-lg px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50">
                    Logout
                </a>
            </nav>
        </aside>

        <!-- Content -->
        <main class="flex-1 overflow-auto">
            <div class="max-w-7xl px-6 py-8">
                @yield('content')
            </div>
        </main>

    </div>

</body>

</html>
