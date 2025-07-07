@extends('layouts.owner')

@section('header', 'Tambah Properti')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <h3 class="text-red-700 font-medium">Terdapat kesalahan dalam pengisian form</h3>
                    </div>
                    <ul class="mt-2 list-disc pl-5 text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('owner.properties.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <!-- Nama Properti -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Properti</label>
                        <input name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>

                    <!-- Deskripsi -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="description" rows="4" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">{{ old('description') }}</textarea>
                    </div>

                    <!-- Harga per malam -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Harga per malam</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">Rp</span>
                            <input type="number" name="price_per_night" value="{{ old('price_per_night') }}" required
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
                        <input name="facilities" value="{{ old('facilities') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>

                    <!-- Peta Lokasi -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Klik lokasi properti pada peta:</label>
                        <div id="map" class="w-full h-64 rounded-lg border border-gray-300"></div>
                        <p class="mt-1 text-xs text-gray-500">Klik pada peta untuk menentukan lokasi properti</p>
                    </div>

                    <!-- Koordinat Tersembunyi -->
                    <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                    <!-- Alamat Detail -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Detail</label>
                        <input name="location" value="{{ old('location') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                    </div>

                    <!-- Upload Gambar -->
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Upload Gambar (bisa lebih dari
                            satu)</label>
                        <div class="mt-1 flex items-center">
                            <label
                                class="w-full flex flex-col items-center px-4 py-6 bg-white text-blue-500 rounded-lg border border-dashed border-gray-300 cursor-pointer hover:bg-gray-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="mt-2 text-sm text-gray-600">Pilih file gambar</span>
                                <input type="file" name="images[]" multiple class="hidden">
                            </label>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, JPEG (maksimal 5MB per gambar)</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                        Simpan Properti
                    </button>
                    <a href="{{ route('owner.properties.index') }}"
                        class="px-6 py-2 text-center text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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

        // Tampilkan nama file yang dipilih
        document.querySelector('input[type="file"]').addEventListener('change', function(e) {
            const files = e.target.files;
            const label = this.closest('label');
            const textSpan = label.querySelector('span');

            if (files.length > 0) {
                if (files.length === 1) {
                    textSpan.textContent = files[0].name;
                } else {
                    textSpan.textContent = `${files.length} file dipilih`;
                }
            } else {
                textSpan.textContent = 'Pilih file gambar';
            }
        });
    </script>
@endpush
