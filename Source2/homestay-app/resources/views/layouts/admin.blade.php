<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex bg-gray-100 min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md">
        <div class="p-4 text-center font-bold text-xl border-b">
            Admin Panel
        </div>
        <nav class="p-4">
            <ul class="space-y-2">
                <li><a href="{{ route('admin.users.dashboard') }}"
                        class="block px-4 py-2 hover:bg-gray-200 rounded">Dashboard</a></li>
                <li><a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-gray-200 rounded">Semua
                        User</a></li>
                <li><a href="{{ route('admin.users.byRole', 'admin') }}"
                        class="block px-4 py-2 hover:bg-gray-200 rounded">Admin</a></li>
                <li><a href="{{ route('admin.users.byRole', 'owner') }}"
                        class="block px-4 py-2 hover:bg-gray-200 rounded">Owner</a></li>
                <li><a href="{{ route('admin.users.byRole', 'customer') }}"
                        class="block px-4 py-2 hover:bg-gray-200 rounded">Customer</a></li>
                <li><a href="{{ route('admin.users.byRole', 'resepsionis') }}"
                        class="block px-4 py-2 hover:bg-gray-200 rounded">Resepsionis</a></li>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>

            </ul>
        </nav>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>
</body>

</html>
