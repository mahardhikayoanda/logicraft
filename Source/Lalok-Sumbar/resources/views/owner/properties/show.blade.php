@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    {{-- Navigation Bar --}}
    <nav class="bg-white shadow-sm border-b px-8 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="{{ route('properties.index') }}" class="text-gray-600 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <h1 class="text-xl font-bold text-gray-800">Detail Properti</h1>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{ route('owner.dashboard') }}" class="text-gray-600 hover:text-gray-800 font-medium">Dashboard</a>
                <a href="{{ route('owner.bookkeeping') }}" class="text-gray-600 hover:text-gray-800 font-medium">Pembukuan</a>
                <a href="{{ route('owner.transactions') }}" class="text-gray-600 hover:text-gray-800 font-medium">Transaksi</a>
            </div>
        </div>
    </nav>

    <div class="px-8 py-8">
        {{-- Property Header --}}
        <div class="bg-white rounded-xl shadow-sm border mb-8">
            <div class="p-8">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $property->name }}</h1>
                        <p class="text-lg text-gray-600 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $property->address }}, {{ $property->city }}, {{ $property->state }}
                        </p>
                    </div>
                    <div class="text-right">
                        <div class="flex space-x-2 mb-3">
                            @if($property->status === 'active')
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">Aktif</span>
                            @else
                                <span class="bg-gray-500 text-white px-3 py-1 rounded-full text-sm font-medium">Tidak Aktif</span>
                            @endif
                            
                            @if($property->rental_status === 'rented')
                                <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-medium">Disewa</span>
                            @elseif($property->rental_status === 'available')
                                <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-medium">Tersedia</span>
                            @endif
                        </div>
                        <div class="space-x-2">
                            <a href="{{ route('properties.edit', $property->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Edit Properti
                            </a>
                            <form action="{{ route('properties.destroy', $property->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus properti ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Property Images --}}
                <div class="mb-8">
                    @if($property->images && $property->images->count() > 0)
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            {{-- Primary Image --}}
                            @php
                                $primaryImage = $property->images->where('is_primary', true)->first();
                                $secondaryImages = $property->images->where('is_primary', false);
                            @endphp
                            
                            @if($primaryImage)
                                <div class="lg:col-span-1">
                                    <img src="{{ Storage::url($primaryImage->path) }}" 
                                         alt="{{ $primaryImage->alt_text }}" 
                                         class="w-full h-80 object-cover rounded-lg shadow-md cursor-pointer"
                                         onclick="openImageModal('{{ Storage::url($primaryImage->path) }}', '{{ $primaryImage->alt_text }}')">
                                </div>
                            @endif
                            
                            {{-- Secondary Images Grid --}}
                            @if($secondaryImages->count() > 0)
                                <div class="grid grid-cols-2 gap-4">
                                    @foreach($secondaryImages->take(4) as $image)
                                        <div class="relative">
                                            <img src="{{ Storage::url($image->path) }}" 
                                                 alt="{{ $image->alt_text }}" 
                                                 class="w-full h-36 object-cover rounded-lg shadow-md cursor-pointer"
                                                 onclick="openImageModal('{{ Storage::url($image->path) }}', '{{ $image->alt_text }}')">
                                            @if($loop->iteration == 4 && $secondaryImages->count() > 4)
                                                <div class="absolute inset-0 bg-black bg-opacity-50 rounded-lg flex items-center justify-center">
                                                    <span class="text-white font-bold text-lg">+{{ $secondaryImages->count() - 4 }} lainnya</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                        {{-- View All Images Button --}}
                        @if($property->images->count() > 5)
                            <button onclick="showAllImages()" class="mt-4 text-blue-600 hover:text-blue-800 font-medium">
                                Lihat Semua {{ $property->images->count() }} Gambar
                            </button>
                        @endif
                    @else
                        <div class="h-80 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                <p class="text-gray-500">Tidak ada gambar tersedia</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Property Details Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Main Details --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Property Information --}}
                <div class="bg-white rounded-xl shadow-sm border p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Properti</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Tipe Properti</label>
                                <p class="text-lg font-semibold text-gray-800">{{ $property->getTypeLabel() }}</p>
                            </div>
                            
                            @if($property->bedrooms)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Kamar Tidur</label>
                                    <p class="text-lg font-semibold text-gray-800">{{ $property->bedrooms }} Kamar</p>
                                </div>
                            @endif
                            
                            @if($property->bathrooms)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Kamar Mandi</label>
                                    <p class="text-lg font-semibold text-gray-800">{{ $property->bathrooms }} Kamar</p>
                                </div>
                            @endif
                            
                            @if($property->area)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Luas Bangunan</label>
                                    <p class="text-lg font-semibold text-gray-800">{{ $property->area }} m²</p>
                                </div>
                            @endif
                        </div>
                        
                        <div class="space-y-4">
                            @if($property->year_built)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Tahun Dibangun</label>
                                    <p class="text-lg font-semibold text-gray-800">{{ $property->year_built }}</p>
                                </div>
                            @endif
                            
                            @if($property->postal_code)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Kode Pos</label>
                                    <p class="text-lg font-semibold text-gray-800">{{ $property->postal_code }}</p>
                                </div>
                            @endif
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Status Properti</label>
                                <p class="text-lg font-semibold text-gray-800">{{ $property->getStatusLabel() }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Status Sewa</label>
                                <p class="text-lg font-semibold text-gray-800">{{ $property->getRentalStatusLabel() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                @if($property->description)
                    <div class="bg-white rounded-xl shadow-sm border p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Deskripsi</h2>
                        <div class="prose prose-gray max-w-none">
                            <p class="text-gray-700 leading-relaxed">{{ $property->description }}</p>
                        </div>
                    </div>
                @endif

                {{-- Location Map Placeholder --}}
                <div class="bg-white rounded-xl shadow-sm border p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Lokasi</h2>
                    <div class="h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-12 h-12 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <p class="text-gray-500">Peta lokasi akan ditampilkan di sini</p>
                            <p class="text-sm text-gray-400 mt-1">{{ $property->address }}, {{ $property->city }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-8">
                {{-- Price Information --}}
                <div class="bg-white rounded-xl shadow-sm border p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Harga</h3>
                    
                    <div class="space-y-4">
                        @if($property->price)
                            <div class="p-4 bg-blue-50 rounded-lg">
                                <label class="block text-sm font-medium text-blue-600 mb-1">Harga Properti</label>
                                <p class="text-2xl font-bold text-blue-800">Rp {{ number_format($property->price, 0, ',', '.') }}</p>
                            </div>
                        @endif
                        
                        @if($property->monthly_rent)
                            <div class="p-4 bg-green-50 rounded-lg">
                                <label class="block text-sm font-medium text-green-600 mb-1">Harga Sewa per Bulan</label>
                                <p class="text-2xl font-bold text-green-800">Rp {{ number_format($property->monthly_rent, 0, ',', '.') }}</p>
                            </div>
                        @endif
                        
                        @if($property->estimated_value)
                            <div class="p-4 bg-purple-50 rounded-lg">
                                <label class="block text-sm font-medium text-purple-600 mb-1">Estimasi Nilai</label>
                                <p class="text-2xl font-bold text-purple-800">Rp {{ number_format($property->estimated_value, 0, ',', '.') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Owner Information --}}
                <div class="bg-white rounded-xl shadow-sm border p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Informasi Pemilik</h3>
                    
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                            @if($property->owner && $property->owner->avatar)
                                <img src="{{ Storage::url($property->owner->avatar) }}" alt="{{ $property->owner->name }}" class="w-12 h-12 rounded-full object-cover">
                            @else
                                <span class="text-white font-bold">{{ $property->owner ? substr($property->owner->name, 0, 1) : 'N' }}</span>
                            @endif
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $property->owner ? $property->owner->name : 'Tidak tersedia' }}</p>
                            <p class="text-sm text-gray-600">Pemilik Properti</p>
                        </div>
                    </div>
                    
                    @if($property->owner && $property->owner->email)
                        <div class="space-y-2">
                            <p class="text-sm text-gray-600">Email:</p>
                            <p class="font-medium text-gray-800">{{ $property->owner->email }}</p>
                        </div>
                    @endif
                </div>

                {{-- Quick Actions --}}
                <div class="bg-white rounded-xl shadow-sm border p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Aksi Cepat</h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('properties.edit', $property->id) }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors text-center block">
                            Edit Properti
                        </a>
                        
                        @if($property->status === 'active')
                            <button onclick="togglePropertyStatus({{ $property->id }}, 'inactive')" class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Nonaktifkan
                            </button>
                        @else
                            <button onclick="togglePropertyStatus({{ $property->id }}, 'active')" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                Aktifkan
                            </button>
                        @endif
                        
                        <button onclick="shareProperty()" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Image Modal --}}
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative max-w-4xl w-full">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <img id="modalImage" src="" alt="" class="w-full h-auto rounded-lg">
            <p id="modalImageCaption" class="text-white text-center mt-4"></p>
        </div>
    </div>
</div>

{{-- All Images Modal --}}
<div id="allImagesModal" class="fixed inset-0 bg-black bg-opacity-90 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-6xl w-full max-h-screen overflow-y-auto">
            <div class="p-6 border-b flex justify-between items-center">
                <h3 class="text-xl font-bold text-gray-800">Semua Gambar Properti</h3>
                <button onclick="closeAllImagesModal()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @if($property->images)
                        @foreach($property->images as $image)
                            <div class="relative">
                                <img src="{{ Storage::url($image->path) }}" 
                                     alt="{{ $image->alt_text }}" 
                                     class="w-full h-48 object-cover rounded-lg cursor-pointer"
                                     onclick="openImageModal('{{ Storage::url($image->path) }}', '{{ $image->alt_text }}')">
                                @if($image->is_primary)
                                    <div class="absolute top-2 left-2">
                                        <span class="bg-blue-500 text-white px-2 py-1 rounded text-xs font-medium">Utama</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Image modal functions
function openImageModal(imageSrc, caption) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('modalImageCaption').textContent = caption;
    document.getElementById('imageModal').classList.remove('hidden');
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

function showAllImages() {
    document.getElementById('allImagesModal').classList.remove('hidden');
}

function closeAllImagesModal() {
    document.getElementById('allImagesModal').classList.add('hidden');
}

// Property status toggle
function togglePropertyStatus(propertyId, newStatus) {
    if (confirm(`Apakah Anda yakin ingin ${newStatus === 'active' ? 'mengaktifkan' : 'menonaktifkan'} properti ini?`)) {
        fetch(`/properties/${propertyId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Terjadi kesalahan. Silakan coba lagi.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    }
}

// Share property
function shareProperty() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $property->name }}',
            text: 'Lihat properti ini: {{ $property->name }}',
            url: window.location.href
        });
    } else {
        // Fallback for browsers that don't support Web Share API
        const tempInput = document.createElement('input');
        tempInput.value = window.location.href;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);
        alert('Link telah disalin ke clipboard!');
    }
}

// Close modals with Escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeImageModal();
        closeAllImagesModal();
    }
});

// Close modals when clicking outside
document.getElementById('imageModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeImageModal();
    }
});

document.getElementById('allImagesModal').addEventListener('click', function(event) {
    if (event.target === this) {
        closeAllImagesModal();
    }
});
</script>
@endsection