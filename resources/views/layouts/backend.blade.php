<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Backend</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 p-4 bg-white shadow">
            <h2 class="mb-4 text-lg font-bold">SPPG MBG</h2>

            <ul class="space-y-2">
                <li>
                    <a href="/backend" class="text-blue-600 hover:underline">
                        Dashboard
                    </a>
                </li>

                @if(auth()->user()->role === 'admin')
                <li>
                    <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:underline">
                        Manajemen User
                    </a>
                </li>
                @endif

                @if(auth()->user()->role === 'petugas_gizi')
                <li>
                    <a href="{{ route('gizi.dashboard') }}" class="text-blue-600 hover:underline">
                        Kelola Data Gizi
                    </a>
                </li>
                @endif

                @if(auth()->user()->role === 'petugas_pengaduan')
                <li>
                    <a href="{{ route('backend.pengaduan.index') }}" class="text-blue-600 hover:underline">
                        Kelola Pengaduan
                    </a>
                </li>
                @endif

                <li class="mt-4">
                    <a href="/logout" class="text-red-600 hover:underline">
                        Logout
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Content -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>

    </div>

</body>
</html>
