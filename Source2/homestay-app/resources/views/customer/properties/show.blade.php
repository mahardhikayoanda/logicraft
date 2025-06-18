<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        {{-- Judul Properti --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $property->name }}</h2>

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
                <label>Deskripsi</label>
                <p class="text-gray-700">{{ $property->description }}</p>
            </div>
            <div class="mb-4">
                <label>Lokasi</label>
                <p class="text-gray-700">{{ $property->location }}</p>
            </div>
            <div class="mb-4">
                <label>Fasilitas</label>
                <p class="text-gray-700">{{ $property->facilities }}</p>
            </div>
            <p class="mt-4 text-lg font-semibold text-green-700">
                Harga: <span class="text-black">Rp {{ number_format($property->price_per_night) }}</span> / malam
            </p>
            <a href="{{ route('customer.reservations.create', $property->id) }}"
                class="bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block">
                Pesan Sekarang
            </a>
        </div>

        {{-- Peta Lokasi Properti --}}
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <h3 class="text-xl font-semibold mb-4">📍 Lokasi Properti</h3>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Cari Lokasi:</label>
                <input type="text" id="searchInput" class="border p-2 w-full rounded" placeholder="Contoh: Monas, Jakarta">
                <button onclick="cariLokasi()" class="mt-2 bg-blue-500 text-white px-3 py-1 rounded">Cari</button>
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

    {{-- OpenStreetMap & Leaflet JS --}}
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
</x-app-layout>
