@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    {{-- Navigation Bar --}}
    <nav class="bg-white shadow-sm border-b px-8 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Tambah Properti Baru</h1>
            <div class="flex items-center space-x-6">
                <a href="{{ route('owner.properties') }}" class="text-gray-600 hover:text-gray-800 font-medium">← Kembali ke Daftar Properti</a>
                <a href="{{ route('owner.dashboard') }}" class="text-gray-600 hover:text-gray-800 font-medium">Dashboard</a>
            </div>
        </div>
    </nav>

    <div class="px-8 py-8">
        {{-- Error Messages --}}
        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada form:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{-- Form --}}
        <div class="bg-white rounded-lg shadow-sm border">
            <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                {{-- Basic Information --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Dasar</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Properti *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipe Properti *</label>
                            <select id="type" name="type" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Pilih Tipe</option>
                                <option value="apartment" {{ old('type') == 'apartment' ? 'selected' : '' }}>Apartemen</option>
                                <option value="house" {{ old('type') == 'house' ? 'selected' : '' }}>Rumah</option>
                                <option value="office" {{ old('type') == 'office' ? 'selected' : '' }}>Kantor</option>
                                <option value="shop" {{ old('type') == 'shop' ? 'selected' : '' }}>Toko</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description') }}</textarea>
                    </div>
                </div>

                {{-- Location --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Lokasi</h3>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                            <textarea id="address" name="address" rows="2" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('address') }}</textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Kota *</label>
                                <input type="text" id="city" name="city" value="{{ old('city') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                                <input type="text" id="state" name="state" value="{{ old('state') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                                <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Property Details --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Detail Properti</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <label for="bedrooms" class="block text-sm font-medium text-gray-700 mb-2">Kamar Tidur</label>
                            <input type="number" id="bedrooms" name="bedrooms" value="{{ old('bedrooms') }}" min="0" max="20"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="bathrooms" class="block text-sm font-medium text-gray-700 mb-2">Kamar Mandi</label>
                            <input type="number" id="bathrooms" name="bathrooms" value="{{ old('bathrooms') }}" min="0" max="20"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="area" class="block text-sm font-medium text-gray-700 mb-2">Luas (m²)</label>
                            <input type="number" id="area" name="area" value="{{ old('area') }}" min="0" step="0.01"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="year_built" class="block text-sm font-medium text-gray-700 mb-2">Tahun Dibangun</label>
                            <input type="number" id="year_built" name="year_built" value="{{ old('year_built') }}" min="1800" max="{{ date('Y') + 5 }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                {{-- Status & Pricing --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Status & Harga</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Properti *</label>
                            <select id="status" name="status" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Pilih Status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                        <div>
                            <label for="rental_status" class="block text-sm font-medium text-gray-700 mb-2">Status Sewa *</label>
                            <select id="rental_status" name="rental_status" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">Pilih Status Sewa</option>
                                <option value="available" {{ old('rental_status') == 'available' ? 'selected' : '' }}>Tersedia</option>
                                <option value="occupied" {{ old('rental_status') == 'occupied' ? 'selected' : '' }}>Disewa</option>
                                <option value="maintenance" {{ old('rental_status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                        </div>
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Harga Properti (Rp) *</label>
                            <input type="number" id="price" name="price" value="{{ old('price') }}" min="0" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Masukkan harga properti">
                        </div>
                        <div>
                            <label for="monthly_rent" class="block text-sm font-medium text-gray-700 mb-2">Sewa per Bulan (Rp)</label>
                            <input type="number" id="monthly_rent" name="monthly_rent" value="{{ old('monthly_rent') }}" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="estimated_value" class="block text-sm font-medium text-gray-700 mb-2">Nilai Estimasi (Rp)</label>
                            <input type="number" id="estimated_value" name="estimated_value" value="{{ old('estimated_value') }}" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
                {{-- Images --}}
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Foto Properti</h3>
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Upload Foto (Maks 5MB per file)</label>
                        <input type="file" id="images" name="images[]" multiple accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="text-sm text-gray-500 mt-1">Format yang didukung: JPEG, PNG, JPG, GIF, WebP</p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-end space-x-4 pt-6 border-t">
                    <button type="button" onclick="window.location.href='{{ route('owner.properties') }}'"
                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                        Simpan Properti
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Format number inputs
document.getElementById('price').addEventListener('input', function(e) {
    // Remove non-digits
    let value = e.target.value.replace(/\D/g, '');
    e.target.value = value;
});

document.getElementById('monthly_rent').addEventListener('input', function(e) {
    // Remove non-digits
    let value = e.target.value.replace(/\D/g, '');
    e.target.value = value;
});

document.getElementById('estimated_value').addEventListener('input', function(e) {
    // Remove non-digits  
    let value = e.target.value.replace(/\D/g, '');
    e.target.value = value;
});

// Image preview functionality
document.getElementById('images').addEventListener('change', function(e) {
    const files = e.target.files;
    console.log(`Selected ${files.length} files`);
    
    // You can add image preview functionality here if needed
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        if (file.size > 5 * 1024 * 1024) { // 5MB
            alert(`File ${file.name} terlalu besar. Maksimal 5MB per file.`);
            e.target.value = '';
            break;
        }
    }
});
</script>
@endsection