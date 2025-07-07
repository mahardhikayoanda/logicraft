@extends('layouts.guest')

@section('title', 'Temukan Penginapan Anda')

@section('content')
    <!-- Hero Section with Search -->
    <section class="relative bg-cover bg-center h-screen min-h-[600px] max-h-[800px]"
        style="background-image: url('{{ asset('rumah.jpeg') }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30 flex items-center justify-center">
            <div class="text-center px-4 max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 text-white animate-fadeIn">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-red-600">Temukan</span>
                    Penginapan Impian Anda
                </h1>
                <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl mx-auto animate-fadeIn delay-100">
                    Jelajahi penginapan terbaik di Sumatera Barat dengan harga terbaik
                </p>

                <!-- Search Box -->
                <div
                    class="bg-white/90 backdrop-blur-sm p-4 rounded-xl shadow-2xl animate-fadeIn delay-200 transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <form action="{{ route('guest.properties.index') }}" method="GET"
                        class="flex flex-col md:flex-row gap-2">
                        <div class="flex-1">
                            <label for="location" class="sr-only">Lokasi</label>
                            <input type="text" name="search" placeholder="Cari properti atau lokasi..."
                                value="{{ request('search') }}"
                                class="w-full border border-gray-200 px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200">
                        </div>
                        <button type="submit"
                            class="bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 px-6 py-3 rounded-lg text-white font-semibold transition-all duration-300 shadow-lg hover:shadow-xl">
                            Cari
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <a href="#promosi" class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div
                class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </a>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Promosi Aktif with Carousel -->
        <section id="promosi" class="mb-20">
            <div class="flex justify-between items-center mb-8">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-red-500 to-red-600 p-2 rounded-lg mr-3 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Promosi Spesial</h2>
                </div>
                @if ($promotions->count() > 3)
                    <div class="flex gap-2">
                        <button
                            class="promo-prev-btn p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-all duration-200 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <button
                            class="promo-next-btn p-2 rounded-full bg-gray-100 hover:bg-gray-200 transition-all duration-200 shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

            @if ($promotions->isEmpty())
                <div class="text-center py-12 bg-gray-50 rounded-xl border border-gray-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="mt-4 text-gray-600 font-medium">Belum ada promosi aktif saat ini.</p>
                    <p class="text-sm text-gray-500 mt-1">Silakan cek kembali nanti untuk penawaran spesial.</p>
                </div>
            @else
                <div class="promo-carousel-container relative overflow-hidden">
                    <div class="promo-carousel swiper">
                        <div class="swiper-wrapper">
                            @foreach ($promotions as $promo)
                                <div class="swiper-slide">
                                    <div
                                        class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl h-full border border-gray-100 group">
                                        @if ($promo->image_path)
                                            <div class="relative h-48 overflow-hidden">
                                                <img src="{{ asset('storage/' . $promo->image_path) }}"
                                                    alt="{{ $promo->title }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                                <div
                                                    class="absolute top-4 right-4 bg-gradient-to-r from-red-600 to-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                                    PROMO
                                                </div>
                                            </div>
                                        @endif
                                        <div class="p-5">
                                            <div class="flex justify-between items-start mb-2">
                                                <h3
                                                    class="text-lg font-bold text-gray-800 group-hover:text-red-600 transition-colors duration-200">
                                                    {{ $promo->title }}</h3>
                                                <span
                                                    class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full font-medium">
                                                    {{ \Carbon\Carbon::parse($promo->end_date)->diffForHumans() }}
                                                </span>
                                            </div>
                                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($promo->start_date)->format('d M Y') }} -
                                                {{ \Carbon\Carbon::parse($promo->end_date)->format('d M Y') }}
                                            </div>
                                            <p class="text-sm text-gray-600 line-clamp-2 mb-4">{{ $promo->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination mt-6"></div>
                </div>
            @endif
        </section>

        <!-- Properti Populer with Tabs -->
        <section class="mb-20">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
                <div class="flex items-center">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-2 rounded-lg mr-3 shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Properti Populer</h2>
                </div>
            </div>

            @if ($properties->isEmpty())
                <div class="text-center py-12 bg-gray-50 rounded-xl border border-gray-200 shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada properti tersedia</h3>
                    <p class="mt-1 text-gray-500">Silakan coba filter pencarian yang berbeda.</p>
                    <div class="mt-6">
                        <a href="{{ route('guest.properties.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 transition-all duration-300">
                            Lihat Semua Properti
                        </a>
                    </div>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 property-grid">
                    @foreach ($properties as $property)
                        <div
                            class="property-item bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 border border-gray-100 group">
                            @if ($property->images->isNotEmpty())
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                        alt="{{ $property->name }}">
                                    <div
                                        class="absolute top-4 left-4 bg-white/90 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                                        {{ $property->type }}
                                    </div>
                                    @php
                                        $reviews = $property->reservations->pluck('review')->filter();
                                        $avgRating = $reviews->avg('rating');
                                    @endphp
                                    @if ($avgRating)
                                        <div
                                            class="absolute bottom-4 left-4 flex items-center bg-white/90 px-2 py-1 rounded-full shadow-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                            <span
                                                class="ml-1 text-sm font-medium text-gray-700">{{ number_format($avgRating, 1) }}</span>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-5">
                                <h3
                                    class="text-lg font-bold text-gray-800 mb-2 group-hover:text-red-600 transition-colors duration-200">
                                    {{ $property->name }}</h3>

                                <p class="flex items-center text-sm text-gray-600 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $property->location }}
                                </p>

                                <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-100">
                                    <div>
                                        <p class="text-sm font-bold text-red-600">
                                            Rp {{ number_format($property->price_per_night, 0, ',', '.') }} <span
                                                class="text-gray-500 font-normal">/malam</span>
                                        </p>
                                    </div>
                                    <a href="{{ route('guest.properties.show', $property->id) }}"
                                        class="inline-flex items-center px-3 py-1.5 border border-red-600 text-sm font-medium rounded-md text-red-600 bg-white hover:bg-red-50 hover:text-red-700 transition-all duration-200">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12 text-center">
                    <a href="{{ route('guest.properties.index') }}"
                        class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-lg text-white bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 transition-all duration-300 hover:shadow-xl">
                        Lihat Semua Properti
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            @endif
        </section>

        <!-- Call to Action -->
        <section class="bg-gradient-to-r from-red-600 to-red-500 rounded-xl p-8 md:p-12 text-center text-white shadow-xl">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Siap untuk Petualangan di Sumatera Barat?</h2>
                <p class="text-lg mb-6 opacity-90">Temukan penginapan terbaik untuk liburan tak terlupakan Anda.</p>
                <div class="flex justify-center">
                    <a href="{{ route('guest.properties.index') }}"
                        class="px-8 py-3 bg-white text-red-600 font-semibold rounded-lg hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                        Jelajahi Properti
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
    <style>
        .animate-fadeIn {
            animation: fadeIn 0.8s ease-out;
        }

        .animate-fadeIn.delay-100 {
            animation-delay: 0.1s;
        }

        .animate-fadeIn.delay-200 {
            animation-delay: 0.2s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-bounce {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-15px);
            }

            60% {
                transform: translateY(-7px);
            }
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Swiper Styles */
        .promo-carousel-container {
            position: relative;
            padding: 0 15px;
            margin: 0 -15px;
        }

        .promo-carousel {
            overflow: hidden;
            width: 100%;
        }

        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-wrapper {
            display: flex;
            width: 100%;
            height: 100%;
            box-sizing: border-box;
        }

        .swiper-slide {
            flex-shrink: 0;
            width: 100%;
            height: 100%;
            position: relative;
        }

        .swiper-pagination {
            position: relative;
            bottom: auto;
            margin-top: 20px;
        }

        .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background: #d1d5db;
            opacity: 1;
            transition: all 0.3s ease;
        }

        .swiper-pagination-bullet-active {
            background: #dc2626;
            transform: scale(1.2);
        }

        .swiper-button-disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #dc2626;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #b91c1c;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Promo Carousel with autoplay
            const promoCarousel = new Swiper('.promo-carousel', {
                slidesPerView: 1,
                spaceBetween: 20,
                grabCursor: true,
                loop: {{ $promotions->count() > 3 ? 'true' : 'false' }},
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true,
                },
                navigation: {
                    nextEl: '.promo-next-btn',
                    prevEl: '.promo-prev-btn',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    }
                },
                on: {
                    init: function() {
                        toggleNavButtons(this);
                    },
                    slideChange: function() {
                        toggleNavButtons(this);
                    }
                }
            });

            function toggleNavButtons(swiper) {
                const prevBtn = document.querySelector('.promo-prev-btn');
                const nextBtn = document.querySelector('.promo-next-btn');

                if (swiper.isBeginning) {
                    prevBtn.classList.add('swiper-button-disabled');
                } else {
                    prevBtn.classList.remove('swiper-button-disabled');
                }

                if (swiper.isEnd) {
                    nextBtn.classList.add('swiper-button-disabled');
                } else {
                    nextBtn.classList.remove('swiper-button-disabled');
                }
            }

            // Add hover pause to carousel
            const carouselContainer = document.querySelector('.promo-carousel-container');
            if (carouselContainer) {
                carouselContainer.addEventListener('mouseenter', () => {
                    promoCarousel.autoplay.stop();
                });
                carouselContainer.addEventListener('mouseleave', () => {
                    promoCarousel.autoplay.start();
                });
            }

            // Animate elements on scroll
            const animateOnScroll = () => {
                const elements = document.querySelectorAll('.property-item, .promo-carousel-container');

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
        });
    </script>
@endpush
