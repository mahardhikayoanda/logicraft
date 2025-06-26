<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'LalokSumbar')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Tambahkan favicon dan font jika perlu --}}
</head>

<body class="bg-gray-100 text-gray-800">

    {{-- Header --}}
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('guest.properties.index') }}" class="text-xl font-bold text-green-600">
                LalokSumbar
            </a>
            <nav class="space-x-4">
                <a href="{{ route('guest.properties.index') }}" class="text-gray-700 hover:text-green-600">Beranda</a>
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
            </nav>
        </div>
    </header>

    {{-- Konten Utama --}}
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t mt-12">
        <div class="container mx-auto px-4 py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} LalokSumbar. Semua hak dilindungi.
        </div>
    </footer>

    @stack('scripts')
</body>

</html>
