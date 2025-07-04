<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'LalokSumbar - Temukan Penginapan di Sumatera Barat')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Temukan penginapan terbaik di Sumatera Barat dengan LalokSumbar. Villa, hotel, homestay, dan berbagai properti menarik lainnya.">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ url('favicon.png') }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['"Playfair Display"', 'serif']
                    },
                    colors: {
                        primary: {
                            600: '#dc2626',
                            700: '#b91c1c'
                        },
                        dark: {
                            900: '#111827'
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in',
                        'slide-down': 'slideDown 0.3s ease-out'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            }
                        },
                        slideDown: {
                            '0%': {
                                transform: 'translateY(-10px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            }
                        }
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')

    <style>
        .mobile-menu {
            transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            max-height: 0;
            overflow: hidden;
        }

        .mobile-menu.open {
            max-height: 500px;
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #dc2626;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .back-to-top {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .footer-link:hover {
            transform: translateX(5px);
            transition: transform 0.2s ease;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">
    <!-- Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50 backdrop-blur-sm bg-white/90">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4 md:justify-start md:space-x-10">
                <!-- Logo -->
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <a href="{{ route('guest.properties.index') }}" class="flex items-center group">
                        <img src="{{ url('rb-logo.png') }}" alt="LalokSumbar"
                            class="h-10 md:h-12 transition-transform duration-300 group-hover:scale-105">
                        <span
                            class="ml-2 text-xl md:text-2xl font-bold text-primary-600 logo-font hidden sm:inline group-hover:text-primary-700 transition-colors duration-300">
                            LalokSumbar
                        </span>
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="-mr-2 -my-2 md:hidden">
                    <button type="button" id="mobile-menu-button"
                        class="rounded-md p-2 inline-flex items-center justify-center text-gray-500 hover:text-primary-600 hover:bg-gray-100 focus:outline-none transition-colors duration-200"
                        aria-expanded="false">
                        <span class="sr-only">Open menu</span>
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex space-x-8 items-center">
                    <a href="{{ route('guest.home') }}"
                        class="text-base font-medium text-gray-700 hover:text-primary-600 transition-colors duration-200 nav-link {{ request()->is('/') ? 'active text-primary-600' : '' }}">
                        Beranda
                    </a>
                    <a href="{{ route('guest.properties.index') }}"
                        class="text-base font-medium text-gray-700 hover:text-primary-600 transition-colors duration-200 nav-link {{ request()->is('guest/properties*') ? 'active text-primary-600' : '' }}">
                        Properti
                    </a>
                </nav>

                <!-- Auth Buttons -->
                <div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0 space-x-4">
                    <a href="{{ route('login') }}"
                        class="whitespace-nowrap text-base font-medium text-gray-700 hover:text-primary-600 transition-colors duration-200 nav-link">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="ml-8 whitespace-nowrap inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary-600 hover:bg-primary-700 transition-all duration-200 hover:shadow-md">
                        Daftar
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="mobile-menu md:hidden bg-white border-t border-gray-200 shadow-lg">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('guest.home') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition-colors duration-200 {{ request()->is('/') ? 'text-primary-600 bg-gray-50' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('guest.properties.index') }}"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 hover:bg-gray-50 transition-colors duration-200 {{ request()->is('guest/properties*') ? 'text-primary-600 bg-gray-50' : '' }}">
                    Properti
                </a>
                <div class="pt-4 border-t border-gray-200">
                    <a href="{{ route('login') }}"
                        class="block w-full px-4 py-2 rounded-md text-base font-medium text-gray-700 hover:text-primary-600 transition-colors duration-200">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}"
                        class="mt-2 block w-full px-4 py-2 rounded-md text-center text-base font-medium text-white bg-primary-600 hover:bg-primary-700 transition-colors duration-200">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- About Section -->
                <div class="md:col-span-2">
                    <div class="flex items-center group">
                        <img src="{{ url('rb-logo.png') }}" alt="LalokSumbar"
                            class="h-8 transition-transform duration-300 group-hover:scale-105">
                        <span
                            class="ml-2 text-xl font-bold text-white logo-font group-hover:text-primary-600 transition-colors duration-300">
                            LalokSumbar
                        </span>
                    </div>
                    <p class="text-gray-400 mt-4 max-w-lg">
                        Platform pencarian penginapan terbaik di Sumatera Barat. Temukan villa, hotel, homestay, dan
                        berbagai properti menarik lainnya untuk pengalaman menginap yang tak terlupakan.
                    </p>
                    <div class="flex space-x-4 mt-6">
                        <a href="#"
                            class="text-gray-400 hover:text-white transition-colors duration-200 w-8 h-8 flex items-center justify-center rounded-full hover:bg-primary-600">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#"
                            class="text-gray-400 hover:text-white transition-colors duration-200 w-8 h-8 flex items-center justify-center rounded-full hover:bg-primary-600">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#"
                            class="text-gray-400 hover:text-white transition-colors duration-200 w-8 h-8 flex items-center justify-center rounded-full hover:bg-primary-600">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#"
                            class="text-gray-400 hover:text-white transition-colors duration-200 w-8 h-8 flex items-center justify-center rounded-full hover:bg-primary-600">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Contact Section -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 relative inline-block">
                        <span class="relative z-10">Hubungi Kami</span>
                        <span class="absolute bottom-0 left-0 w-full h-1 bg-primary-600 z-0 opacity-20"></span>
                    </h3>
                    <ul class="space-y-4 text-gray-400">
                        <li class="flex items-start footer-link">
                            <i class="fas fa-map-marker-alt mt-1 mr-4 text-primary-600"></i>
                            <span>Jl. Sudirman No. 123, Bukittinggi, Sumatera Barat</span>
                        </li>
                        <li class="flex items-center footer-link">
                            <i class="fas fa-phone-alt mr-4 text-primary-600"></i>
                            <span>+62 812 3456 7890</span>
                        </li>
                        <li class="flex items-center footer-link">
                            <i class="fas fa-envelope mr-4 text-primary-600"></i>
                            <span>info@laloksumbar.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="mt-16 pt-8 border-t border-gray-800 text-center text-gray-400 text-sm">
                <p>&copy; 2025 LalokSumbar.com. All rights reserved. Designed & Developed by <a href="#"
                        class="text-primary-600 hover:text-primary-500 transition-colors duration-200">LogiCraft</a>
                </p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="back-to-top"
        class="fixed bottom-8 right-8 bg-primary-600 text-white p-3 rounded-full shadow-lg hover:bg-primary-700 transition-all duration-300 opacity-0 invisible back-to-top flex items-center justify-center w-12 h-12">
        <i class="fas fa-arrow-up"></i>
    </button>

    @stack('scripts')

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            const expanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !expanded);
            mobileMenu.classList.toggle('open');
        });

        // Back to top button
        const backToTopButton = document.getElementById('back-to-top');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.remove('opacity-0', 'invisible');
                backToTopButton.classList.add('opacity-100', 'visible');
            } else {
                backToTopButton.classList.remove('opacity-100', 'visible');
                backToTopButton.classList.add('opacity-0', 'invisible');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Close mobile menu when clicking on a link
        const mobileMenuLinks = document.querySelectorAll('#mobile-menu a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('open');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            });
        });

        // Add animation to elements when they come into view
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.animate-on-scroll');

            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (elementPosition < windowHeight - 100) {
                    element.classList.add('animate-fade-in');
                }
            });
        };

        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>
</body>

</html>
