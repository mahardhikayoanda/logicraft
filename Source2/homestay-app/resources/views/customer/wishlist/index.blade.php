@extends('layouts.customer')

@section('title', 'Wishlist Saya')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Wishlist Saya</h1>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($wishlistedProperties->isEmpty())
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 text-gray-400 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">Wishlist kosong</h3>
                <p class="mt-2 text-gray-500">Anda belum menambahkan properti ke wishlist.</p>
                <div class="mt-6">
                    <a href="{{ route('customer.properties.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Jelajahi Properti
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($wishlistedProperties as $property)
                    <div
                        class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <!-- Property Image with Remove Button -->
                        <div class="relative">
                            @if ($property->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                                    alt="{{ $property->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">Tidak ada gambar</span>
                                </div>
                            @endif

                            <!-- Remove from Wishlist Button -->
                            <form method="POST" action="{{ route('customer.wishlist.destroy', $property->id) }}"
                                class="absolute top-3 right-3">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-2 bg-white rounded-full shadow-md hover:bg-red-100 transition-colors duration-200"
                                    onclick="return confirm('Hapus dari wishlist?')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>

                            <!-- Price Tag -->
                            <div class="absolute bottom-3 left-3 bg-white/90 px-3 py-1 rounded-full shadow-sm">
                                <span
                                    class="font-bold text-red-600">Rp{{ number_format($property->price_per_night, 0, ',', '.') }}</span>
                                <span class="text-xs text-gray-500">/malam</span>
                            </div>
                        </div>

                        <!-- Property Details -->
                        <div class="p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $property->name }}</h3>
                                    <p class="text-sm text-gray-600 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ Str::limit($property->location, 28) }}
                                    </p>
                                </div>

                                <!-- Rating -->
                                @if ($property->average_rating)
                                    <div class="flex items-center bg-gray-100 px-2 py-1 rounded">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span
                                            class="ml-1 text-sm font-medium">{{ number_format($property->average_rating, 1) }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Facilities (Icons) -->
                            @if ($property->facilities)
                                <div class="mt-3 flex flex-wrap gap-2">
                                    @foreach (array_slice(explode(',', $property->facilities), 0, 3) as $facility)
                                        <span
                                            class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">{{ trim($facility) }}</span>
                                    @endforeach
                                    @if (count(explode(',', $property->facilities)) > 3)
                                        <span
                                            class="text-xs bg-gray-100 text-gray-700 px-2 py-1 rounded">+{{ count(explode(',', $property->facilities)) - 3 }}
                                            more</span>
                                    @endif
                                </div>
                            @endif

                            <!-- Action Buttons -->
                            <div class="mt-4 flex justify-between">
                                <a href="{{ route('customer.properties.show', $property->id) }}"
                                    class="flex-1 mr-2 bg-white border border-red-600 text-red-600 hover:bg-red-50 font-medium py-2 px-4 rounded-lg text-center transition-colors duration-200">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
