@extends('layouts.owner')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Edit Properti</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('owner.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block font-medium">Nama Properti</label>
            <input name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name', $property->name) }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Deskripsi</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded" required>{{ old('description', $property->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Harga per malam</label>
            <input type="number" name="price_per_night" class="w-full border px-3 py-2 rounded"
                value="{{ old('price_per_night', $property->price_per_night) }}" required>
        </div>

        {{-- Lokasi dari Peta --}}
        <label for="map">Klik lokasi properti pada peta:</label>
        <div id="map" class="w-full h-64 mb-4 rounded"></div>

        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $property->latitude) }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $property->longitude) }}">


        <div class="mb-4">
            <label class="block font-medium">Alamat Detail</label>
            <input name="location" class="w-full border px-3 py-2 rounded"
                value="{{ old('location', $property->location) }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Fasilitas</label>
            <input name="facilities" class="w-full border px-3 py-2 rounded"
                value="{{ old('facilities', $property->facilities) }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Upload Gambar Baru (Opsional)</label>
            <input type="file" name="images[]" multiple class="w-full border px-3 py-2 rounded">
        </div>

        @if ($property->images->isNotEmpty())
            <div class="mb-4">
                <label class="block font-medium mb-2">Gambar Saat Ini</label>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($property->images as $img)
                        <div>
                            <img src="{{ asset('storage/' . $img->image_path) }}" alt="Gambar Properti"
                                class="w-full h-32 object-cover rounded">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="flex gap-4 mt-6">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Perbarui</button>
            <a href="{{ route('owner.properties.index') }}" class="text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
@endsection
@push('scripts')
    <script>
        // Ambil koordinat awal dari properti
        const initialLat = {{ $property->latitude ?? -0.7893 }};
        const initialLng = {{ $property->longitude ?? 113.9213 }};

        const map = L.map('map').setView([initialLat, initialLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Tambahkan marker awal
        let marker = L.marker([initialLat, initialLng]).addTo(map);

        // Jika user klik di peta, update koordinat dan posisi marker
        map.on('click', function(e) {
            const {
                lat,
                lng
            } = e.latlng;

            marker.setLatLng([lat, lng]);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    </script>
@endpush
