@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    {{-- Header Profile --}}
    <div class="px-8 py-8">
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
                    <p class="text-sm text-gray-600 font-medium">Property Owner</p>
                    <p class="text-sm text-gray-500 mt-1">Selamat datang kembali! Pantau dan kelola bisnis properti Anda.</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <button onclick="window.location.href='{{ route('profile.edit') }}'" class="bg-black hover:bg-gray-800 text-white px-6 py-2 rounded-lg text-sm font-medium transition-colors">
                    Update Profile
                </button>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition-colors">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        {{-- Navigation Cards --}}
        <div class="mb-12">
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Menu Utama</h3>
            <p class="text-sm text-gray-600 mb-8">Akses cepat ke fitur-fitur utama sistem</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Properties Card --}}
                <div onclick="window.location.href='{{ route('owner.properties') }}'" class="bg-white rounded-xl shadow-sm border hover:shadow-md transition-all cursor-pointer group">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                                <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold text-blue-600">{{ $totalProperties ?? 0 }}</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Properti</h4>
                        <p class="text-sm text-gray-600 mb-4">Kelola data properti Anda</p>
                        <div class="flex items-center text-blue-600 text-sm font-medium">
                            <span>Lihat Semua</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Bookkeeping Card --}}
                <div onclick="window.location.href='{{ route('owner.bookkeeping') }}'" class="bg-white rounded-xl shadow-sm border hover:shadow-md transition-all cursor-pointer group">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-200 transition-colors">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold text-green-600">{{ $totalIncome ?? 0 }}</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Pembukuan</h4>
                        <p class="text-sm text-gray-600 mb-4">Kelola keuangan dan laporan</p>
                        <div class="flex items-center text-green-600 text-sm font-medium">
                            <span>Lihat Detail</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Transactions Card --}}
                <div onclick="window.location.href='{{ route('owner.transactions') }}'" class="bg-white rounded-xl shadow-sm border hover:shadow-md transition-all cursor-pointer group">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                                <svg class="w-6 h-6 text-orange-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold text-orange-600">{{ $totalTransactions ?? 0 }}</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Transaksi</h4>
                        <p class="text-sm text-gray-600 mb-4">Riwayat transaksi terkini</p>
                        <div class="flex items-center text-orange-600 text-sm font-medium">
                            <span>Lihat Semua</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Analytics Card --}}
                <div onclick="toggleAnalytics()" class="bg-white rounded-xl shadow-sm border hover:shadow-md transition-all cursor-pointer group">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                                </svg>
                            </div>
                            <span class="text-2xl font-bold text-purple-600">100%</span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-2">Analytics</h4>
                        <p class="text-sm text-gray-600 mb-4">Statistik dan laporan</p>
                        <div class="flex items-center text-purple-600 text-sm font-medium">
                            <span>Lihat Detail</span>
                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-lg p-6 shadow-sm border">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Total Pendapatan</p>
                        <p class="text-2xl font-bold text-green-600">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-6 shadow-sm border">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Properti Aktif</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $activeProperties ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-6 shadow-sm border">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 mb-1">Sedang Disewa</p>
                        <p class="text-2xl font-bold text-orange-600">{{ $occupiedProperties ?? 0 }}</p>
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
                        <p class="text-sm text-gray-500 mb-1">Tingkat Hunian</p>
                        <p class="text-2xl font-bold text-purple-600">{{ $occupancyRate ?? 0 }}%</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Analytics Section --}}
        <div id="analyticsSection" class="mb-12" style="display: none;">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Analytics & Reports</h3>
                    <p class="text-sm text-gray-600">Pantau performa bisnis properti Anda</p>
                </div>
                <button onclick="toggleAnalytics()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="bg-white rounded-lg border p-8">
                <div class="text-center">
                    <div class="w-full h-64 bg-gray-100 rounded border border-gray-300 flex items-center justify-center mb-6">
                        <div class="text-center">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <p class="text-gray-500">Grafik Analytics akan ditampilkan di sini</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Pendapatan Bulan Ini</h4>
                            <p class="text-2xl font-bold text-green-600">Rp {{ number_format($monthlyRevenue ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Properti Tersewa</h4>
                            <p class="text-2xl font-bold text-blue-600">{{ $rentedProperties ?? 0 }}/{{ $totalProperties ?? 0 }}</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-gray-800 mb-2">Rata-rata Harga Sewa</h4>
                            <p class="text-2xl font-bold text-purple-600">Rp {{ number_format($averageRent ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recent Activities --}}
        <div class="mb-12">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">Aktivitas Terbaru</h3>
                    <p class="text-sm text-gray-600">Pantau aktivitas terkini dari properti Anda</p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg border">
                @if(isset($recentActivities) && count($recentActivities) > 0)
                    @foreach($recentActivities as $activity)
                        <div class="p-6 border-b last:border-b-0">
                            <div class="flex items-start space-x-4">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800">{{ $activity['title'] }}</h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $activity['description'] }}</p>
                                    <p class="text-xs text-gray-400 mt-2">{{ $activity['time'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2">Belum Ada Aktivitas</h4>
                        <p class="text-gray-600">Aktivitas terbaru akan muncul di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="text-center border-t pt-8 pb-4 mt-16 text-sm text-gray-600 bg-white">
        <div class="flex justify-center space-x-8">
            <a href="#" class="hover:text-gray-800 transition-colors">Tentang</a>
            <a href="#" class="hover:text-gray-800 transition-colors">Bantuan</a>
            <a href="#" class="hover:text-gray-800 transition-colors">Kontak</a>
        </div>
        <p class="mt-4 text-xs text-gray-400">© 2025 Lalok Sumbar. All Rights Reserved</p>
    </footer>
</div>

<script>
function toggleAnalytics() {
    const section = document.getElementById('analyticsSection');
    if (section.style.display === 'none') {
        section.style.display = 'block';
        section.scrollIntoView({ behavior: 'smooth' });
    } else {
        section.style.display = 'none';
    }
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