<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'LalokSumbar')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap">
</head>

<body class="font-inter text-gray-800 bg-gray-50">

    {{-- Navbar --}}
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('guest.properties.index') }}" class="text-2xl font-bold text-red-600">LalokSumbar</a>
            <nav class="space-x-6 hidden md:block">
                <a href="{{ route('guest.properties.index') }}" class="hover:text-red-500">Home</a>
                <a href="{{ route('guest.properties.index') }}" class="hover:text-red-500">Property</a>
                <a href="{{ route('login') }}" class="text-red-600 font-semibold">Register / Login</a>
            </nav>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-black text-white mt-16 py-10">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 px-4 text-sm">
            <div>
                <h4 class="font-bold text-xl mb-2">Singgah LalokSumbar</h4>
                <p>Temukan penginapan terbaik di Sumatera Barat.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-2">Office Address</h4>
                <p>Head: Jhon Doe</p>
                <p>Bukittinggi, Sumatera Barat</p>
                <p>Padang, Sumatera Barat</p>
            </div>
            <div>
                <h4 class="font-semibold mb-2">Contact Seller</h4>
                <p>Darrell Steward</p>
                <p>📞 (+971) 555–55812</p>
                <p>📧 roomsforrentals@gmail.com</p>
            </div>
            <div>
                <h4 class="font-semibold mb-2">Newsletter</h4>
                <input type="text" class="w-full px-2 py-1 text-black rounded" placeholder="Your email address">
                <button class="mt-2 bg-red-600 px-4 py-1 rounded text-white">Sign Up</button>
            </div>
        </div>
        <div class="text-center text-sm mt-6">
            <p>© 2025 LalokSumbar.com. Designed & Developed by LogiCraft</p>
        </div>
    </footer>

</body>

</html>
