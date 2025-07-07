@extends('layouts.guest')

@section('title', $property->name)

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Back Button -->
            <div class="flex justify-start mb-8"> <!-- Container to align right -->
                <a href="{{ route('guest.properties.index') }}"
                    class="inline-flex items-center border-2 border-gray-200 hover:border-red-300 px-5 py-2.5 rounded-lg transition-all duration-200 group bg-white shadow-sm hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-2 text-gray-600 group-hover:text-red-600 transition-transform group-hover:-translate-x-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium text-gray-700 group-hover:text-red-600">Kembali</span>
                </a>
            </div>

            <!-- Property Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-8">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">{{ $property->name }}</h1>
                    <div class="flex items-center text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $property->location }}</span>
                    </div>
                </div>

                @php
                    $reviews = $property->reservations->pluck('review')->filter();
                    $avgRating = $reviews->avg('rating');
                @endphp

                @if ($avgRating)
                    <div class="flex flex-col items-end">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="h-6 w-6 {{ $i <= round($avgRating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                            <span class="ml-2 text-gray-700 font-medium">{{ number_format($avgRating, 1) }}</span>
                        </div>
                        <span class="text-sm text-gray-500 mt-1">{{ $reviews->count() }} ulasan</span>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Image Gallery -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 mb-12">
            <!-- Main Image -->
            @if ($property->images->isNotEmpty())
                <div class="lg:col-span-2 row-span-2">
                    <div class="relative h-full w-full rounded-xl overflow-hidden shadow-lg group">
                        <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105 cursor-pointer"
                            alt="{{ $property->name }}"
                            onclick="openImageModal('{{ asset('storage/' . $property->images->first()->image_path) }}')">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent flex items-end p-6">
                            <span class="text-white font-medium">Klik untuk memperbesar</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Additional Images -->
            @if ($property->images->count() > 1)
                @foreach ($property->images->slice(1, 2) as $img)
                    <div class="hidden lg:block">
                        <div class="relative h-full w-full rounded-xl overflow-hidden shadow-lg group">
                            <img src="{{ asset('storage/' . $img->image_path) }}"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105 cursor-pointer"
                                alt="Foto properti" onclick="openImageModal('{{ asset('storage/' . $img->image_path) }}')">
                        </div>
                    </div>
                @endforeach
            @endif

            @if ($property->images->count() > 3)
                <div class="hidden lg:block relative rounded-xl overflow-hidden shadow-lg group">
                    <img src="{{ asset('storage/' . $property->images[3]->image_path) }}"
                        class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105 cursor-pointer"
                        alt="Foto properti"
                        onclick="openImageModal('{{ asset('storage/' . $property->images[3]->image_path) }}')">
                    @if ($property->images->count() > 4)
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <span class="text-white font-bold text-xl">+{{ $property->images->count() - 4 }} Foto</span>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Mobile Image Gallery -->
        @if ($property->images->count() > 1)
            <div class="lg:hidden mb-12">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Galeri Foto</h3>
                <div class="grid grid-cols-2 gap-3">
                    @foreach ($property->images->slice(1) as $img)
                        <div class="relative rounded-lg overflow-hidden shadow-md group">
                            <img src="{{ asset('storage/' . $img->image_path) }}"
                                class="w-full h-40 object-cover transition-transform duration-300 group-hover:scale-105 cursor-pointer"
                                alt="Foto properti" onclick="openImageModal('{{ asset('storage/' . $img->image_path) }}')">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column -->
            <div class="lg:col-span-2">
                <!-- Property Details -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">Tentang Properti Ini</h2>
                    <div class="prose max-w-none text-gray-700">
                        {{ $property->description ?? 'Tidak ada deskripsi tersedia.' }}
                    </div>
                </div>

                <!-- Facilities -->
                @if ($property->facilities)
                    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                        <h2 class="text-2xl font-bold mb-4 text-gray-800">Fasilitas</h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach (explode(',', $property->facilities) as $facility)
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-700">{{ trim($facility) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Property Location Map -->
                <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                    <h2 class="text-2xl font-bold mb-4 text-gray-800">📍 Lokasi</h2>
                    <div id="map" class="w-full h-80 rounded-lg overflow-hidden mb-4"></div>
                    <p class="text-gray-600 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $property->location }}
                    </p>
                </div>

                <!-- Reviews Section -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-800">Ulasan Tamu</h2>
                        @if ($reviews->isNotEmpty())
                            <div class="flex items-center">
                                <span
                                    class="text-2xl font-bold text-gray-800 mr-2">{{ number_format($avgRating, 1) }}</span>
                                <div class="flex">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="h-5 w-5 {{ $i <= round($avgRating) ? 'text-yellow-400' : 'text-gray-300' }}"
                                            fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        @endif
                    </div>

                    @if ($reviews->isEmpty())
                        <p class="text-gray-600 py-4">Belum ada ulasan untuk properti ini.</p>
                    @else
                        <div class="space-y-6">
                            @foreach ($reviews as $review)
                                <div class="border-b border-gray-200 pb-6 last:border-0 last:pb-0">
                                    <div class="flex items-center mb-3">
                                        <div
                                            class="w-10 h-10 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 font-bold mr-3">
                                            {{ substr($review->customer->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800">{{ $review->customer->name }}</p>
                                            <div class="flex items-center">
                                                <div class="flex mr-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                            fill="currentColor" viewBox="0 0 20 20">
                                                            <path
                                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                        </svg>
                                                    @endfor
                                                </div>
                                                <span
                                                    class="text-sm text-gray-500">{{ $review->created_at->format('d M Y') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($review->review)
                                        <p class="text-gray-700 pl-13">{{ $review->review }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column (Booking Widget) -->
            <div>
                <div class="bg-white rounded-xl shadow-lg sticky top-6 overflow-hidden">
                    <!-- Price Box -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-end mb-2">
                            <span
                                class="text-3xl font-bold text-red-600">Rp{{ number_format($property->price_per_night, 0, ',', '.') }}</span>
                            <span class="text-gray-500 ml-1">/malam</span>
                        </div>
                    </div>

                    <!-- Booking Form -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-4 text-gray-800">Pesan Sekarang</h3>

                        <form method="GET" action="" class="space-y-4">
                            <div>
                                <label for="check_in_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                    Check-in</label>
                                <input type="date" id="check_in_date" name="check_in_date"
                                    value="{{ request('check_in_date') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                    min="{{ date('Y-m-d') }}" required>
                            </div>

                            <div>
                                <label for="check_out_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                    Check-out</label>
                                <input type="date" id="check_out_date" name="check_out_date"
                                    value="{{ request('check_out_date') }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                    min="{{ date('Y-m-d') }}" required>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 text-white font-bold py-3 px-4 rounded-lg shadow-md transition-all duration-300">
                                Cek Ketersediaan
                            </button>
                        </form>

                        @php
                            $isBooked = false;
                            if (request()->filled('check_in_date') && request()->filled('check_out_date')) {
                                $checkIn = request('check_in_date');
                                $checkOut = request('check_out_date');
                                $isBooked = $property->isBookedOn($checkIn, $checkOut);
                            }
                        @endphp

                        @if (request()->filled('check_in_date') && request()->filled('check_out_date'))
                            @if (!$isBooked)
                                <div class="mt-6">
                                    <a href="{{ route('customer.reservations.create', [
                                        'property' => $property->id,
                                        'check_in_date' => request('check_in_date'),
                                        'check_out_date' => request('check_out_date'),
                                    ]) }}"
                                        class="block w-full bg-green-600 hover:bg-green-700 text-white text-center font-bold py-3 px-4 rounded-lg shadow-md transition-colors duration-300">
                                        Lanjutkan Pemesanan
                                    </a>
                                </div>
                            @else
                                <div class="mt-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                                    <p class="font-medium">Properti tidak tersedia pada tanggal tersebut.</p>
                                    <p class="text-sm mt-1">Silakan coba tanggal lain.</p>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Modal -->
    <div id="imageModal"
        class="fixed inset-0 bg-black/90 flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <button onclick="closeImageModal()"
            class="absolute top-6 right-6 text-white text-4xl hover:text-gray-300 transition-colors">&times;</button>
        <div class="relative max-w-6xl w-full p-6">
            <img id="modalImage" src="" class="max-h-[90vh] max-w-full mx-auto rounded-lg shadow-2xl"
                alt="Preview">
        </div>
    </div>

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    @push('scripts')
        <script>
            // Image Modal Functions
            function openImageModal(imageSrc) {
                const modal = document.getElementById('imageModal');
                const modalImage = document.getElementById('modalImage');
                modalImage.src = imageSrc;
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            function closeImageModal() {
                document.getElementById('imageModal').classList.add('hidden');
                document.body.style.overflow = '';
            }

            // Close modal when clicking outside the image
            document.getElementById('imageModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeImageModal();
                }
            });

            // Close modal with ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeImageModal();
                }
            });

            // Initialize Map
            document.addEventListener('DOMContentLoaded', function() {
                if (document.getElementById('map')) {
                    let map = L.map('map').setView(
                        [{{ $property->latitude ?? '-6.200000' }}, {{ $property->longitude ?? '106.816666' }}],
                        15
                    );

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap contributors'
                    }).addTo(map);

                    let marker = L.marker([
                            {{ $property->latitude ?? '-6.200000' }},
                            {{ $property->longitude ?? '106.816666' }}
                        ]).addTo(map)
                        .bindPopup("<b>{{ $property->name }}</b><br>{{ $property->location }}")
                        .openPopup();
                }

                // Set min date for check-out to be after check-in
                document.getElementById('check_in_date')?.addEventListener('change', function() {
                    const checkInDate = this.value;
                    const checkOutInput = document.getElementById('check_out_date');

                    if (checkOutInput) {
                        checkOutInput.min = checkInDate;

                        // If current check-out date is before new check-in date, reset it
                        if (checkOutInput.value && checkOutInput.value < checkInDate) {
                            checkOutInput.value = '';
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
