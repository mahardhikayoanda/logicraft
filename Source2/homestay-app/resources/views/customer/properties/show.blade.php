@extends('layouts.customer')

@section('title', $property->name)

@section('content')
    <div class="max-w-4xl mx-auto p-4">

        {{-- Gambar Properti --}}
        @if ($property->images->count())
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                @foreach ($property->images as $image)
                    <div class="overflow-hidden rounded-xl shadow-md">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gambar Properti"
                            class="w-full h-40 object-cover transition-transform duration-300 hover:scale-105">
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Deskripsi Properti --}}
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <div class="mb-4">
                <label class="font-semibold text-gray-600">Deskripsi</label>
                <p class="text-gray-700">{{ $property->description }}</p>
            </div>
            <div class="mb-4">
                <label class="font-semibold text-gray-600">Lokasi</label>
                <p class="text-gray-700">{{ $property->location }}</p>
            </div>
            <div class="mb-4">
                <label class="font-semibold text-gray-600">Fasilitas</label>
                <p class="text-gray-700">{{ $property->facilities }}</p>
            </div>
            <div class="mb-4">
                <label class="font-semibold text-gray-600">Harga per malam</label>
                <p class="text-green-700 font-semibold">Rp {{ number_format($property->price_per_night) }}</p>
            </div><h3 class="text-lg font-bold mt-6 mb-2">Ulasan</h3>

            @if ($property->reservations->isEmpty() || $property->reservations->every(fn($r) => !$r->review))
                <p class="text-gray-600">Belum ada ulasan.</p>
            @else
                <div class="space-y-4">
                    @foreach ($property->reservations as $reservation)
                        @if ($reservation->review)
                            <div class="p-4 border rounded bg-gray-50">
                                <p class="font-semibold">{{ $reservation->review->customer->name }}</p>
                                <p class="text-yellow-500">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span>{{ $i <= $reservation->review->rating ? '★' : '☆' }}</span>
                                    @endfor
                                </p>
                                <p>{{ $reservation->review->comment }}</p>
                                <p class="text-sm text-gray-500">{{ $reservation->review->created_at->format('d M Y') }}</p>
                            </div>
                        @endif
                    @endforeach
                </div>
            @endif
    </div>

    {{-- Peta Lokasi Properti --}}
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h3 class="text-xl font-semibold mb-4">📍 Lokasi Properti</h3>

        <div id="map" class="w-full h-64 rounded mb-4"></div>
    </div>

    {{-- Form Cek Ketersediaan --}}
    <form method="GET" action="" class="bg-white p-4 rounded-lg shadow mb-6">
        <h3 class="text-lg font-bold mb-4 text-gray-700">Cek Ketersediaan</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="check_in_date" class="block text-sm font-medium text-gray-700">Tanggal Check-in</label>
                <input type="date" id="check_in_date" name="check_in_date" value="{{ request('check_in_date') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div>
                <label for="check_out_date" class="block text-sm font-medium text-gray-700">Tanggal Check-out</label>
                <input type="date" id="check_out_date" name="check_out_date" value="{{ request('check_out_date') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600">Cek
            Ketersediaan</button>
    </form>

    {{-- Tombol Wishlist --}}
    <form method="POST" action="{{ route('customer.wishlist.store', $property->id) }}">
        @csrf
        <button type="submit" class="inline-flex items-center bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-5 h-5 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.623-2.127-4.75-4.75-4.75-1.574 0-3.033.788-3.958 2.019A5.003 5.003 0 007.75 3.5C5.127 3.5 3 5.627 3 8.25c0 6.215 9 12.75 9 12.75s9-6.535 9-12.75z" />
            </svg>
            Wishlist
        </button>
    </form>

    {{-- Logika untuk Menentukan Ketersediaan --}}
    @php
        $isBooked = false;
        if (request()->filled('check_in_date') && request()->filled('check_out_date')) {
            $checkIn = request('check_in_date');
            $checkOut = request('check_out_date');
            $isBooked = $property->isBookedOn($checkIn, $checkOut);
        }
    @endphp

    {{-- Tampilkan Tombol atau Pesan --}}
    @if (request()->filled('check_in_date') && request()->filled('check_out_date'))
        @if (!$isBooked)
            <div class="flex flex-wrap items-center gap-2">
                {{-- Tombol Pesan --}}
                <a href="{{ route('customer.reservations.create', [
                    'property' => $property->id,
                    'check_in_date' => request('check_in_date'),
                    'check_out_date' => request('check_out_date'),
                ]) }}"
                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Pesan Sekarang
                </a>
            </div>
        @else
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded">
                Properti tidak tersedia pada tanggal tersebut.
            </div>
        @endif
    @endif
    </div>

    {{-- Leaflet CSS & JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        let map = L.map('map').setView(
            [{{ $property->latitude ?? '-6.200000' }}, {{ $property->longitude ?? '106.816666' }}],
            13
        );

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([
            {{ $property->latitude ?? '-6.200000' }},
            {{ $property->longitude ?? '106.816666' }}
        ]).addTo(map);
    </script>
@endsection
