<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Resepsionis</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gray-100">
    {{-- Sidebar --}}
    <aside class="w-64 bg-green-800 text-white p-6 flex flex-col justify-between">
        <div>
            <h2 class="text-xl font-bold mb-6">Resepsionis Panel</h2>
            <ul class="space-y-4">
                <li><a href="#" class="hover:text-yellow-300">Dashboard</a></li>
                <li><a href="{{ route('resepsionis.promotions.index') }}" class="hover:text-yellow-300">Promosi</a></li>
                <li><a href="{{ route('resepsionis.reservations.index') }}" class="hover:text-yellow-300">Daftar Reservasi</a></li>

                {{-- <li><a href="{{ route('owner.reports.index') }}" class="hover:text-yellow-300">Laporan Pembukuan</a> --}}
                </li>
            </ul>
        </div>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="mt-8">
            @csrf
            <button type="submit" class="w-full text-left mt-4 text-red-300 hover:text-red-500">
                Logout
            </button>
        </form>
    </aside>

    {{-- Konten Utama --}}
    <main class="flex-1 p-8">
        @yield('content')
    </main>
</body>

</html>
