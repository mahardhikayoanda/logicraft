@extends('layouts.customer')

@section('title', 'Jelajahi Properti')

@section('content')
    <!-- Hero Section with Search -->
    <section class="relative bg-cover bg-center h-screen min-h-[600px] max-h-[800px]"
        style="background-image: url('{{ asset('rumah.jpeg') }}');">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/30 flex items-center justify-center">
            <div class="text-center px-4 max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 text-white animate-fadeIn">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-red-600">Jelajahi</span>
                    Penginapan di Sumatera Barat
                </h1>
                <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl mx-auto animate-fadeIn delay-100">
                    Temukan berbagai pilihan penginapan terbaik untuk liburan Anda
                </p>

                <!-- Search Box -->
                <div
                    class="bg-white/90 backdrop-blur-sm p-4 rounded-xl shadow-2xl animate-fadeIn delay-200 transform transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <form action="{{ route('customer.properties.index') }}" method="GET"
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
        <a href="#property-list" class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" id="property-list">
        @if ($properties->isEmpty())
            <div class="text-center py-12 bg-gray-50 rounded-xl border border-gray-200 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Tidak ada properti tersedia</h3>
                <p class="mt-1 text-gray-500">Silakan coba filter pencarian yang berbeda.</p>
            </div>
        @else
            <!-- Property Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 property-grid">
                @foreach ($properties as $property)
                    <div
                        class="property-item bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 border border-gray-100 group">
                        @if ($property->images->isNotEmpty() && file_exists(public_path('storage/' . $property->images->first()->image_path)))
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
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
                                <a href="{{ route('customer.properties.show', $property->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 border border-red-600 text-sm font-medium rounded-md text-red-600 bg-white hover:bg-red-50 hover:text-red-700 transition-all duration-200">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($properties->hasPages())
                <div class="mt-12">
                    {{ $properties->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection

@push('styles')
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
    </style>
@endpush
