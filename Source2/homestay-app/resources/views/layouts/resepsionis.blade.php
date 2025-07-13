<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Resepsionis')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            height: 100vh;
            overflow: hidden;
        }

        #app-container {
            display: flex;
            height: 100vh;
            width: 100%;
            position: relative;
        }

        /* Sidebar Styles - Changed to gray */
        .sidebar {
            background: linear-gradient(180deg, #4b5563 0%, #1f2937 100%);
            transition: all 0.3s ease;
            width: 280px;
            height: 100vh;
            flex-shrink: 0;
            overflow: hidden;
            position: relative;
            z-index: 50;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-content {
            display: flex;
            flex-direction: column;
            height: 100%;
            width: 280px;
        }

        .sidebar.collapsed .sidebar-content {
            width: 80px;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s ease;
            background-color: #f9fafb;
        }

        /* Collapsed State */
        .sidebar:not(.collapsed)~.main-content {
            width: calc(100% - 280px);
        }

        .sidebar.collapsed~.main-content {
            width: calc(100% - 80px);
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -280px;
                transition: left 0.3s ease;
                z-index: 1000;
            }

            .sidebar.open {
                left: 0;
                box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            }

            .sidebar.collapsed {
                left: -280px;
            }

            .main-content {
                width: 100% !important;
            }
        }

        /* Navigation Items */
        .nav-item {
            position: relative;
            transition: all 0.2s;
            white-space: nowrap;
            display: flex;
            align-items: center;
            padding: 12px 16px;
            overflow: hidden;
            color: #f3f4f6;
        }

        .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.05);
            color: #fef08a;
        }

        .nav-item.active {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: #f59e0b;
            border-radius: 0 4px 4px 0;
        }

        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .logo-text,
        .sidebar.collapsed .user-info {
            display: none;
        }

        .sidebar.collapsed .nav-item {
            justify-content: center;
            padding: 12px 0;
        }

        .sidebar-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            margin-right: 12px;
        }

        .sidebar.collapsed .sidebar-icon {
            margin-right: 0;
        }

        /* Tooltip for collapsed state */
        .nav-item .tooltip {
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background-color: #1f2937;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s;
            margin-left: 10px;
            z-index: 100;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .sidebar.collapsed .nav-item:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }

        /* Mobile menu button animation */
        .mobile-menu-button {
            transition: transform 0.3s ease;
            z-index: 1001;
        }

        .mobile-menu-button.open {
            transform: rotate(90deg);
        }

        /* Mobile bottom menu styles */
        .mobile-bottom-menu {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 40;
            display: none;
            background-color: white;
            border-top: 1px solid #e5e7eb;
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1), 0 -2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .mobile-bottom-menu.open {
            display: block;
            animation: slideUp 0.3s ease-out;
        }

        @keyframes slideUp {
            from {
                transform: translateY(100%);
            }

            to {
                transform: translateY(0);
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Toggle button in collapsed state */
        #toggle-sidebar {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed #toggle-sidebar {
            position: absolute;
            right: 10px;
            top: 18px;
            display: block !important;
        }

        /* User profile in collapsed state */
        .sidebar.collapsed .user-profile-collapsed {
            display: flex;
            justify-content: center;
            padding: 12px 0;
        }

        .sidebar:not(.collapsed) .user-profile-collapsed {
            display: none;
        }

        /* Mobile menu items */
        .mobile-menu-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            color: #374151;
            font-weight: 500;
            transition: all 0.2s;
        }

        .mobile-menu-item.active {
            color: #1f2937;
            background-color: #f3f4f6;
        }

        .mobile-menu-item i {
            margin-right: 12px;
            width: 24px;
            text-align: center;
            color: #1f2937;
        }
    </style>
</head>

<body class="h-full">
    <!-- Mobile Overlay -->
    <div id="sidebar-overlay" class="sidebar-overlay"></div>

    <div id="app-container">
        <!-- Sidebar - Changed to gray -->
        <aside id="sidebar" class="sidebar text-white">
            <div class="sidebar-content">
                <!-- Logo Section -->
                <div class="p-4 flex items-center justify-between border-b border-gray-600">
                    <div class="flex items-center">
                        <div
                            class="sidebar-icon w-8 h-8 rounded-lg bg-gray-500 flex items-center justify-center text-white">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <span class="logo-text font-bold text-lg ml-3">Resepsionis</span>
                    </div>
                    <button id="toggle-sidebar" class="text-gray-300 hover:text-yellow-300 transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto p-2">
                    <a href="{{ route('resepsionis.dashboard') }}"
                        class="nav-item hover:bg-gray-700 rounded-lg
                              {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}">
                        <div class="sidebar-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <span class="nav-text">Dashboard</span>
                        <span class="tooltip">Dashboard</span>
                    </a>

                    <a href="{{ route('resepsionis.promotions.index') }}"
                        class="nav-item hover:bg-gray-700 rounded-lg
                              {{ request()->routeIs('resepsionis.promotions.*') ? 'active' : '' }}">
                        <div class="sidebar-icon">
                            <i class="fas fa-percentage"></i>
                        </div>
                        <span class="nav-text">Promosi</span>
                        <span class="tooltip">Promosi</span>
                    </a>

                    <a href="{{ route('resepsionis.reservations.index') }}"
                        class="nav-item hover:bg-gray-700 rounded-lg
                              {{ request()->routeIs('resepsionis.reservations.*') ? 'active' : '' }}">
                        <div class="sidebar-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <span class="nav-text">Reservasi</span>
                        <span class="tooltip">Reservasi</span>
                    </a>
                </nav>

                <!-- User Profile -->
                <div class="p-4 border-t border-gray-600">
                    <div class="flex items-center mb-3">
                        <div
                            class="sidebar-icon w-8 h-8 rounded-full bg-gray-500 flex items-center justify-center text-white">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="user-info ml-3">
                            <div class="user-name font-medium text-sm">{{ Auth::user()->name }}</div>
                            <div class="user-role text-xs text-gray-300">Resepsionis</div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full nav-item text-gray-300 hover:text-yellow-300 hover:bg-gray-700 rounded-lg text-left">
                            <div class="sidebar-icon">
                                <i class="fas fa-sign-out-alt"></i>
                            </div>
                            <span class="nav-text">Logout</span>
                            <span class="tooltip">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div id="main-content" class="main-content">
            <!-- Mobile Header -->
            <header class="md:hidden bg-white shadow-sm p-4 flex justify-between items-center sticky top-0 z-50">
                <button id="mobile-menu-button" class="text-gray-600 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-800">@yield('header', 'Dashboard')</h1>
                <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600">
                    <i class="fas fa-user"></i>
                </div>
            </header>

            <!-- Desktop Header -->
            <header class="hidden md:flex items-center justify-between p-4 bg-white shadow-sm sticky top-0 z-40">
                <div class="flex items-center">
                    <button id="toggle-sidebar-mobile" class="mr-3 text-gray-500 hover:text-gray-700">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-xl font-bold text-gray-800">@yield('header', 'Dashboard')</h1>
                </div>
                <div class="flex items-center space-x-3">
                    <div class="text-right">
                        <p class="font-medium text-gray-800 text-sm">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">Resepsionis</p>
                    </div>
                    <div
                        class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-medium">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 p-4 md:p-6">
                @if (session('success'))
                    <div class="mb-4 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-blue-500 mr-3"></i>
                            <span class="text-blue-700 font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Mobile Bottom Menu -->
    <div id="mobile-bottom-menu" class="mobile-bottom-menu md:hidden">
        <div class="px-2 pt-2 pb-4 space-y-1">
            <a href="{{ route('resepsionis.dashboard') }}"
                class="mobile-menu-item {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('resepsionis.promotions.index') }}"
                class="mobile-menu-item {{ request()->routeIs('resepsionis.promotions.*') ? 'active' : '' }}">
                <i class="fas fa-percentage"></i>
                <span>Promosi</span>
            </a>
            <a href="{{ route('resepsionis.reservations.index') }}"
                class="mobile-menu-item {{ request()->routeIs('resepsionis.reservations.*') ? 'active' : '' }}">
                <i class="fas fa-calendar-check"></i>
                <span>Reservasi</span>
            </a>
            <div class="pt-2 border-t border-gray-200">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="mobile-menu-item w-full text-left">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const toggleSidebar = document.getElementById('toggle-sidebar');
            const toggleSidebarMobile = document.getElementById('toggle-sidebar-mobile');
            const sidebarOverlay = document.getElementById('sidebar-overlay');
            const mobileBottomMenu = document.getElementById('mobile-bottom-menu');

            // Check localStorage for collapsed state
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                if (toggleSidebar) {
                    const icon = toggleSidebar.querySelector('i');
                    icon.classList.remove('fa-chevron-left');
                    icon.classList.add('fa-chevron-right');
                }
            }

            // Toggle sidebar for desktop
            if (toggleSidebar) {
                toggleSidebar.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');

                    // Save state to localStorage
                    const isCollapsed = sidebar.classList.contains('collapsed');
                    localStorage.setItem('sidebarCollapsed', isCollapsed);

                    // Toggle chevron icon direction
                    const icon = this.querySelector('i');
                    if (isCollapsed) {
                        icon.classList.remove('fa-chevron-left');
                        icon.classList.add('fa-chevron-right');
                    } else {
                        icon.classList.remove('fa-chevron-right');
                        icon.classList.add('fa-chevron-left');
                    }
                });
            }

            // Toggle mobile bottom menu
            if (mobileMenuButton) {
                mobileMenuButton.addEventListener('click', function(e) {
                    e.stopPropagation();
                    mobileBottomMenu.classList.toggle('open');

                    // Toggle icon between bars and times
                    const icon = this.querySelector('i');
                    if (mobileBottomMenu.classList.contains('open')) {
                        icon.classList.remove('fa-bars');
                        icon.classList.add('fa-times');
                    } else {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                });
            }

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileBottomMenu.contains(event.target) && event.target !== mobileMenuButton) {
                    mobileBottomMenu.classList.remove('open');
                    const icon = mobileMenuButton?.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            });

            // Toggle sidebar from desktop header button
            if (toggleSidebarMobile) {
                toggleSidebarMobile.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');

                    // Save state to localStorage
                    const isCollapsed = sidebar.classList.contains('collapsed');
                    localStorage.setItem('sidebarCollapsed', isCollapsed);

                    // Update toggle button icon
                    if (toggleSidebar) {
                        const icon = toggleSidebar.querySelector('i');
                        if (isCollapsed) {
                            icon.classList.remove('fa-chevron-left');
                            icon.classList.add('fa-chevron-right');
                        } else {
                            icon.classList.remove('fa-chevron-right');
                            icon.classList.add('fa-chevron-left');
                        }
                    }
                });
            }

            // Handle window resize
            function handleResize() {
                if (window.innerWidth >= 768) {
                    // Hide mobile menu on desktop
                    mobileBottomMenu.classList.remove('open');
                    const icon = mobileMenuButton?.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                    }
                }
            }

            // Initial check
            handleResize();
            window.addEventListener('resize', handleResize);
        });
    </script>

    @stack('scripts')
</body>

</html>
