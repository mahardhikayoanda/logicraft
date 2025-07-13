@extends('layouts.owner')

@section('title', 'Detail Properti')
@section('header', 'Properti')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header Section -->
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Detail Properti</h2>
                <div class="flex items-center text-sm text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Informasi lengkap tentang properti Anda
                </div>
            </div>

            <!-- Property Main Info -->
            <div class="p-6">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $property->name }}</h3>

                <div class="mb-6">
                    <h4 class="text-lg font-semibold text-gray-700 mb-2">Deskripsi</h4>
                    <p class="text-gray-600 leading-relaxed">{{ $property->description }}</p>
                </div>

                <!-- Property Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="text-lg font-semibold text-gray-700 mb-3">Detail Properti</h4>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Lokasi</p>
                                    <p class="text-gray-700">{{ $property->location }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Harga per malam</p>
                                    <p class="text-gray-700">Rp{{ number_format($property->price_per_night, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mt-0.5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Fasilitas</p>
                                    <p class="text-gray-700">{{ $property->facilities }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map Section -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        @if ($property->latitude && $property->longitude)
                            <h4 class="text-lg font-semibold text-gray-700 mb-3">📍 Lokasi Properti</h4>
                            <div id="map" class="w-full h-64 rounded-lg border border-gray-200"></div>
                        @else
                            <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200 text-yellow-700 flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                <div>
                                    <p class="font-medium">Koordinat lokasi belum ditentukan</p>
                                    <p class="text-sm mt-1">Tambahkan koordinat lokasi untuk menampilkan peta</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Property Images -->
                @if ($property->images->count())
                    <div class="mb-6">
                        <h4 class="text-lg font-semibold text-gray-700 mb-3">Galeri Properti</h4>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($property->images as $image)
                                <div class="relative group overflow-hidden rounded-lg aspect-square">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gambar Properti"
                                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300"></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('owner.properties.index') }}"
                        class="flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

@push('scripts')
    {{-- Leaflet JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lat = {{ $property->latitude ?? '0' }};
            const lng = {{ $property->longitude ?? '0' }};
            const name = @json($property->name ?? 'Nama Properti');

            if (lat !== 0 && lng !== 0) {
                let map = L.map('map').setView([lat, lng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors'
                }).addTo(map);

                L.marker([lat, lng]).addTo(map)
                    .bindPopup(`<b>${name}</b><br>${@json($property->location ?? '')}`)
                    .openPopup();
            }
        });
    </script>
@endpush
