<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title') - LalokSumbar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <div class="text-xl font-bold text-blue-600">
                LalokSumbar
            </div>
            <div class="space-x-6">
                <a href="{{ route('customer.dashboard') }}" class="text-gray-700 hover:text-blue-600">Beranda</a>
                <a href="{{ route('customer.reservations.history') }}" class="text-gray-700 hover:text-blue-600">Riwayat</a>
                <a href="{{ route('customer.wishlist.index') }}" class="text-gray-700 hover:text-blue-600">Wishlist</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-gray-700 hover:text-red-600">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">@yield('title')</h1>
        @yield('content')
    </main>

    @yield('scripts')
</body>

</html>
