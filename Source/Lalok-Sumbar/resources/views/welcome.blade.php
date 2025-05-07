<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang - Lalok Sumbar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100 font-sans antialiased">

    <div class="min-h-screen flex flex-col justify-center items-center px-4 text-center">
        <header class="mb-8">
            <h1 class="text-4xl font-bold mb-2">Selamat Datang di Lalok Sumbar</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Temukan penginapan terbaik di Sumatera Barat dengan mudah dan cepat.
            </p>
        </header>

        <div class="flex space-x-4">
            @if (Route::has('login'))
                <a href="{{ route('login') }}"
                   class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">
                    Masuk
                </a>
            @endif

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="px-6 py-3 bg-gray-200 text-gray-900 rounded-lg font-semibold hover:bg-gray-300 transition">
                    Daftar
                </a>
            @endif
        </div>

        <footer class="mt-12 text-sm text-gray-500">
            &copy; {{ date('Y') }} Lalok Sumbar. All rights reserved.
        </footer>
    </div>

</body>
</html>
