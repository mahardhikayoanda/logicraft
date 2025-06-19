@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    {{-- Navigation Bar --}}
    <nav class="bg-white shadow-sm border-b px-8 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Property Data</h1>
            <div class="flex items-center space-x-6">
                <a href="{{ route('owner.dashboard') }}" class="text-gray-600 hover:text-gray-800 font-medium">Dashboard</a>
                <a href="{{ route('owner.bookkeeping') }}" class="text-gray-600 hover:text-gray-800 font-medium">Pembukuan</a>
                <a href="{{ route('owner.transactions') }}" class="text-gray-600 hover:text-gray-800 font-medium">Transaksi</a>
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Cari properti..." class="bg-gray-100 px-4 py-2 rounded-lg text-sm w-48 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <svg class="absolute right-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <div class="relative">
                    <button id="profileDropdown" class="flex items-center space-x-2 text-gray-600 hover:text-gray-800">
                        <span class="font-medium">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="px-8 py-8">
        {{-- Header Profile --}}
        <div class="flex justify-between items-center mb-12">
            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                    @if(Auth::user()->avatar)
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="w-16 h-16 rounded-full object-cover">
                    @else
                        <span class="text-white font-bold text-xl">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    @endif
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                    <p class="text-sm text-gray-600 font-medium">Owner</p>
                    <p class="text-sm text-gray-500 mt-1">Selamat datang kembali! Lihat dan kelola data properti Anda di sini.</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <button onclick="window.location.href='{{ route('properties.create') }}'" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition-colors">
                    + Tambah Properti
                </button>
                <button onclick="window.location.href='{{ route('profile.edit') }}'" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-lg text-sm font-medium transition-colors">
                    Update Profile
                </button>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-lg p-6 shadow-sm border">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Harga Properti</p>
                        <p class="text-2xl font-bold text-purple-600">Rp {{ number_format($properties->sum('price'), 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-6 shadow-sm border">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Properti Aktif</p>
                        <p class="text-2xl font-bold text-green-600">{{ $properties->where('status', 'active')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-6 shadow-sm border">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Sedang Disewa</p>
                        <p class="text-2xl font-bold text-orange-600">{{ $properties->where('rental_status', 'occupied')->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-6 shadow-sm border">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Nilai</p>
                        <p class="text-2xl font-bold text-purple-600">Rp {{ number_format($properties->sum('estimated_value'), 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Alerts/Notifications --}}
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($properties->isEmpty())
            {{-- Empty State --}}
            <div class="bg-white rounded-xl shadow-sm border p-12 text-center">
                <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Properti</h3>
                <p class="text-gray-600 mb-6">Anda belum memiliki properti yang terdaftar. Mulai dengan menambahkan properti pertama Anda.</p>
                <button onclick="window.location.href='{{ route('properties.create') }}'" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    + Tambah Properti Pertama
                </button>
            </div>
        @else
            {{-- Your Properties Section --}}
            <div class="mb-12">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Properti Saya</h3>
                        <p class="text-sm text-gray-600">Lihat dan kelola semua properti yang Anda miliki</p>
                    </div>
                    <div class="flex space-x-3">
                        <select id="filterStatus" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                        <select id="filterType" class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Tipe</option>
                            <option value="apartment">Apartemen</option>
                            <option value="house">Rumah</option>
                            <option value="office">Kantor</option>
                            <option value="shop">Toko</option>
                        </select>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="propertiesGrid">
                    @foreach($properties as $property)
                        <div class="property-card bg-white rounded-xl shadow-sm border hover:shadow-md transition-shadow" 
                             data-status="{{ $property->status }}" 
                             data-type="{{ $property->type }}"
                             data-name="{{ strtolower($property->name) }}"
                             data-address="{{ strtolower($property->address) }}">
                            {{-- Property Image --}}
                            <div class="relative h-48 rounded-t-xl overflow-hidden">
                                @if($property->images && count($property->images) > 0)
                                    
                                    <img src="{{ Storage::url($property->images->first()->path) }}" alt="{{ $property->name }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                        </svg>
                                    </div>
                                @endif
                                
                                {{-- Status Badge --}}
                                <div class="absolute top-3 right-3">
                                    @if($property->status === 'active')
                                        <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">Aktif</span>
                                    @else
                                        <span class="bg-gray-500 text-white px-2 py-1 rounded-full text-xs font-medium">Tidak Aktif</span>
                                    @endif
                                </div>

                                {{-- Rental Status Badge --}}
                                @if($property->rental_status === 'occupied')
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium">Disewa</span>
                                    </div>
                                @elseif($property->rental_status === 'available')
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-medium">Tersedia</span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-6">
                            <div class="flex items-start justify-between mb-3">
                                <h4 class="text-lg font-bold text-gray-800">{{ $property->name }}</h4>
                                <div class="text-right">
                                    <p class="text-lg font-bold text-blue-600 mb-1">
                                        Rp {{ $property->price ? number_format($property->price, 0, ',', '.') : 'Tidak tersedia' }}
                                    </p>
                                    <p class="text-sm font-medium text-green-600">
                                        {{ $property->monthly_rent ? 'Sewa: Rp ' . number_format($property->monthly_rent, 0, ',', '.') . '/bulan' : 'Tidak disewakan' }}
                                    </p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $property->address }}
                            </p>
                            <p class="text-sm font-medium text-gray-700 mb-4">
                                Tipe: {{ ucfirst($property->type) }}
                                @if($property->bedrooms)
                                    • {{ $property->bedrooms }} KT
                                @endif
                                @if($property->bathrooms)
                                    • {{ $property->bathrooms }} KM
                                @endif
                                @if($property->area)
                                    • {{ $property->area }} m²
                                @endif
                            </p>
                            
                            <div class="flex space-x-2">
                                <button onclick="viewPropertyDetail({{ $property->id }})" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    Lihat Detail
                                </button>
                                <button onclick="window.location.href='{{ route('properties.edit', $property->id) }}'" class="flex-1 bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                    Edit
                                </button>
                            </div>
                        </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Property Details Section --}}
            <div class="mb-12" id="selectedPropertyDetails" style="display: none;">
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Detail Properti</h3>
                        <p class="text-sm text-gray-600">Informasi lengkap tentang properti yang dipilih</p>
                    </div>
                    <button onclick="closePropertyDetail()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div id="propertyDetailContent" class="bg-white rounded-lg border p-8">
                    {{-- Content will be loaded dynamically --}}
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Property Detail Modal (Alternative approach) --}}
<div id="propertyModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-screen overflow-y-auto">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Detail Properti</h3>
                    <button onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            <div id="modalContent" class="p-6">
                {{-- Modal content will be loaded here --}}
            </div>
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const cards = document.querySelectorAll('.property-card');
    
    cards.forEach(card => {
        const name = card.dataset.name;
        const address = card.dataset.address;
        const isVisible = name.includes(searchTerm) || address.includes(searchTerm);
        card.style.display = isVisible ? 'block' : 'none';
    });
});

// Filter functionality
document.getElementById('filterStatus').addEventListener('change', applyFilters);
document.getElementById('filterType').addEventListener('change', applyFilters);

function applyFilters() {
    const statusFilter = document.getElementById('filterStatus').value;
    const typeFilter = document.getElementById('filterType').value;
    const cards = document.querySelectorAll('.property-card');
    
    cards.forEach(card => {
        const status = card.dataset.status;
        const type = card.dataset.type;
        
        const statusMatch = !statusFilter || status === statusFilter;
        const typeMatch = !typeFilter || type === typeFilter;
        
        card.style.display = (statusMatch && typeMatch) ? 'block' : 'none';
    });
}

// Profile dropdown
document.getElementById('profileDropdown').addEventListener('click', function() {
    document.getElementById('dropdownMenu').classList.toggle('hidden');
});

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('profileDropdown');
    const menu = document.getElementById('dropdownMenu');
    
    if (!dropdown.contains(event.target)) {
        menu.classList.add('hidden');
    }
});

// View property detail function
function viewPropertyDetail(propertyId) {
    // Show modal approach
    document.getElementById('propertyModal').classList.remove('hidden');
    
    // Load property details via AJAX
    fetch(`/properties/${propertyId}/details`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('modalContent').innerHTML = html;
        })
        .catch(error => {
            console.error('Error loading property details:', error);
            document.getElementById('modalContent').innerHTML = '<p class="text-red-500">Error loading property details. Please try again.</p>';
        });
}

function closeModal() {
    document.getElementById('propertyModal').classList.add('hidden');
}

// Alternative: Inline detail view
function viewPropertyDetailInline(propertyId) {
    const detailSection = document.getElementById('selectedPropertyDetails');
    const contentDiv = document.getElementById('propertyDetailContent');
    
    // Show the detail section
    detailSection.style.display = 'block';
    detailSection.scrollIntoView({ behavior: 'smooth' });
    
    // Load property details
    fetch(`/properties/${propertyId}/details`)
        .then(response => response.text())
        .then(html => {
            contentDiv.innerHTML = html;
        })
        .catch(error => {
            console.error('Error loading property details:', error);
            contentDiv.innerHTML = '<p class="text-red-500">Error loading property details. Please try again.</p>';
        });
}

function closePropertyDetail() {
    document.getElementById('selectedPropertyDetails').style.display = 'none';
}

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('[class*="bg-green-50"], [class*="bg-red-50"]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});
</script>
@endsection