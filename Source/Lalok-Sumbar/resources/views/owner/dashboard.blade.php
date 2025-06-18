@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-between">
    {{-- Navigation Bar --}}
    <nav class="bg-white shadow-sm border-b px-8 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('owner.dashboard') }}">
                <h1 class="text-xl font-bold text-gray-800">Dashboard Owner</h1>
            </a>
            <div class="flex space-x-6">
                <a href="{{ route('owner.bookkeeping') }}" class="text-gray-600 hover:text-gray-800 font-medium">Pembukuan</a>
                <a href="{{ route('owner.properties') }}" class="text-gray-600 hover:text-gray-800 font-medium">Properti</a>
                <a href="{{ route('owner.transactions') }}" class="text-gray-600 hover:text-gray-800 font-medium">Transaksi</a>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="px-8 py-10 flex-1">
        <div class="bg-gray-700 text-white rounded-lg p-6 mb-8 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="w-14 h-14 bg-gray-500 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold">John Doe</h2>
                    <span class="text-xs bg-gray-600 px-2 py-1 rounded text-gray-200">Property Owner</span>
                    <p class="text-sm text-gray-300 mt-1">Kendal</p>
                </div>
            </div>
            <div class="flex flex-col space-y-2">
                <button class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-1.5 rounded text-sm font-medium transition-colors">
                    Keluar
                </button>
                <button class="bg-black hover:bg-gray-900 text-white px-4 py-1.5 rounded text-sm font-medium transition-colors">
                    Profil
                </button>
            </div>
        </div>

        <div class="text-center mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat datang, Owner!</h2>
            <p class="text-sm text-gray-600">Kelola properti dan pantau pemasukan dengan efisien</p>
            <div class="w-full mt-8 flex justify-center">
                <div class="w-full md:w-2/3 h-64 bg-gray-100 rounded border border-gray-300 flex items-center justify-center">
                    <span class="text-gray-400">[ Grafik / Ringkasan Aktivitas Akan Ditampilkan Di Sini ]</span>
                </div>
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="text-center border-t pt-8 pb-4 mt-16 text-sm text-gray-600">
        <div class="flex justify-center space-x-8">
            <a href="#" class="hover:text-gray-800 transition-colors">Tentang</a>
            <a href="#" class="hover:text-gray-800 transition-colors">Bantuan</a>
            <a href="#" class="hover:text-gray-800 transition-colors">Kontak</a>
        </div>
        <p class="mt-4 text-xs text-gray-400">© 2025 Lalok Sumbar. All Rights Reserved</p>
    </footer>
</div>
@endsection
