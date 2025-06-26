@extends('layouts.owner')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Tambah Properti</h2>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('owner.properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block font-medium">Nama Properti</label>
            <input name="name" class="w-full border px-3 py-2 rounded" value="{{ old('name') }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Deskripsi</label>
            <textarea name="description" class="w-full border px-3 py-2 rounded" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Harga per malam</label>
            <input type="number" name="price_per_night" class="w-full border px-3 py-2 rounded"
                value="{{ old('price_per_night') }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Klik lokasi properti pada peta:</label>
            <div id="map" class="w-full h-64 rounded border"></div>
        </div>

        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

        <div class="mb-4">
            <label class="block font-medium">Alamat Detail</label>
            <input name="location" class="w-full border px-3 py-2 rounded" value="{{ old('location') }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Fasilitas</label>
            <input name="facilities" class="w-full border px-3 py-2 rounded" value="{{ old('facilities') }}" required>
        </div>

        <div class="mb-4">
            <label class="block font-medium">Upload Gambar (bisa lebih dari satu)</label>
            <input type="file" name="images[]" multiple class="w-full border px-3 py-2 rounded">
        </div>

        <div class="flex gap-4 mt-6">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Simpan</button>
            <a href="{{ route('owner.properties.index') }}" class="text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
@endsection
@push('scripts')
    <script>
        // Inisialisasi Peta Leaflet
        var map = L.map('map').setView([-0.7893, 113.9213], 5); // Default lokasi Indonesia

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker;

        // Saat peta diklik
        map.on('click', function(e) {
            const {
                lat,
                lng
            } = e.latlng;

            // Jika marker sudah ada, update posisinya
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }

            // Isi input tersembunyi
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        });
    </script>
@endpush
