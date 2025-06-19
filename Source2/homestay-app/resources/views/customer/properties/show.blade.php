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
            </div>
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

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600">
                Cek Ketersediaan
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
                <a href="{{ route('customer.reservations.create', [
                    'property' => $property->id,
                    'check_in_date' => request('check_in_date'),
                    'check_out_date' => request('check_out_date'),
                ]) }}"
                    class="bg-green-500 text-white px-4 py-2 rounded inline-block hover:bg-green-600">
                    Pesan Sekarang
                </a>
            @else
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded">
                    Properti tidak tersedia pada tanggal tersebut.
                </div>
            @endif
        @endif

        {{-- Peta Lokasi Properti --}}
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <h3 class="text-xl font-semibold mb-4">📍 Lokasi Properti</h3>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Cari Lokasi:</label>
                <input type="text" id="searchInput" class="border p-2 w-full rounded" placeholder="Contoh: Monas, Jakarta">
                <button onclick="cariLokasi()" type="button" class="mt-2 bg-blue-500 text-white px-3 py-1 rounded">Cari</button>
            </div>

            <div id="map" class="w-full h-64 rounded mb-4"></div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="latitude" class="block font-medium">Latitude</label>
                    <input type="text" id="latitude" name="latitude" class="border p-2 w-full rounded"
                        value="{{ $property->latitude ?? '' }}">
                </div>
                <div>
                    <label for="longitude" class="block font-medium">Longitude</label>
                    <input type="text" id="longitude" name="longitude" class="border p-2 w-full rounded"
                        value="{{ $property->longitude ?? '' }}">
                </div>
            </div>
        </div>
    </div>

    {{-- Leaflet CSS & JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        let map = L.map('map').setView([{{ $property->latitude ?? '-6.200000' }}, {{ $property->longitude ?? '106.816666' }}], 13);
        let marker = L.marker([{{ $property->latitude ?? '-6.200000' }}, {{ $property->longitude ?? '106.816666' }}]).addTo(map);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        function cariLokasi() {
            let lokasi = document.getElementById('searchInput').value;
            if (!lokasi) {
                alert("Masukkan lokasi yang ingin dicari.");
                return;
            }

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${lokasi}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        let lat = data[0].lat;
                        let lon = data[0].lon;

                        document.getElementById('latitude').value = lat;
                        document.getElementById('longitude').value = lon;

                        map.setView([lat, lon], 14);

                        if (marker) {
                            map.removeLayer(marker);
                        }

                        marker = L.marker([lat, lon]).addTo(map);
                    } else {
                        alert("Lokasi tidak ditemukan.");
                    }
                })
                .catch(error => {
                    console.error("Terjadi kesalahan:", error);
                    alert("Terjadi kesalahan saat mencari lokasi.");
                });
        }
    </script>
@endsection