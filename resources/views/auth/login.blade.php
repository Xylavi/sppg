<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SPPG - Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-linear-to-br from-cyan-700 to-sky-600 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo/Header Section -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">SPPG Kokrosono</h1>
            <p class="text-cyan-50">Portal Menu, Gizi & Pengaduan Masyarakat</p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-2xl shadow-2xl p-8">
            <h2 class="text-2xl font-bold text-slate-900 mb-6 text-center">Masuk ke Dashboard</h2>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-lg">
                    <ul class="space-y-2">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm text-rose-700 flex items-start gap-2">
                                <span class="text-rose-600 font-bold">•</span>
                                <span>{{ $error }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="/login" class="space-y-4">
                @csrf

                <div>
                    <label for="username" class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition"
                        required autofocus>
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" placeholder="Masukkan password"
                        class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent outline-none transition"
                        required>
                </div>

                <button type="submit"
                    class="w-full bg-linear-to-r from-cyan-700 to-sky-600 hover:from-cyan-800 hover:to-sky-700 text-white font-semibold py-3 rounded-lg transition duration-200 mt-6">
                    Masuk
                </button>
            </form>

            <!-- Footer Info -->
            <div class="mt-6 pt-6 border-t border-slate-200 text-center text-sm text-slate-600">
                <p>Hubungi admin jika mengalami kendala</p>
            </div>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 text-center text-cyan-50 text-sm">
            <p>© 2026 Oxy Laviosa </p>
        </div>
    </div>
</body>

</html>
