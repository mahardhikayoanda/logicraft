@extends('layouts.admin')

@section('content')
    <div class="flex-1 bg-gray-50 min-h-screen">
        <div class="p-6">
            <!-- Top Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Welcome Card -->
                <div class="lg:col-span-2">
                    <div
                        class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-2xl p-6 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <h2 class="text-xl font-bold mb-2">Halo, {{ Auth::user()->name }}!</h2>
                            <p class="text-orange-100 text-sm">Selamat datang di panel admin</p>
                        </div>
                        <div
                            class="absolute right-4 top-4 w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C13.1 2 14 2.9 14 4C14 5.1 13.1 6 12 6C10.9 6 10 5.1 10 4C10 2.9 10.9 2 12 2ZM21 9V7L15 7.5V9C15 10.1 14.1 11 13 11S11 10.1 11 9V7.5L5 7V9C5 10.1 4.1 11 3 11S1 10.1 1 9V7C1 6.4 1.4 6 2 6H22C22.6 6 23 6.4 23 7V9C23 10.1 22.1 11 21 11S21 10.1 21 9Z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Add User Section -->
                    <div class="mt-6 bg-white rounded-2xl p-6 shadow border border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Tambah User Baru</h3>
                        <p class="text-gray-600 text-sm mb-4">Kelola pengguna sistem dengan mudah</p>
                        <a href="{{ route('admin.users.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Tambah User
                        </a>
                    </div>
                </div>

                <!-- Calendar Section -->
                <div class="bg-white rounded-2xl p-6 shadow border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Kalender</h3>
                    <div class="space-y-3">
                        <div class="grid grid-cols-7 gap-1 text-center text-xs font-medium text-gray-500 mb-2">
                            <div>M</div>
                            <div>S</div>
                            <div>S</div>
                            <div>R</div>
                            <div>K</div>
                            <div>J</div>
                            <div>S</div>
                        </div>
                        <div class="grid grid-cols-7 gap-1 text-center text-sm">
                            @for ($i = 1; $i <= 31; $i++)
                                <div
                                    class="p-2 hover:bg-gray-100 rounded cursor-pointer {{ $i == date('j') ? 'bg-orange-500 text-white' : 'text-gray-700' }}">
                                    {{ $i }}
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                <!-- Total Users -->
                <div class="bg-white rounded-xl p-6 shadow border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Pengguna</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Admin Users -->
                <div class="bg-white rounded-xl p-6 shadow border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Admin</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $adminCount }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Owner Users -->
                <div class="bg-white rounded-xl p-6 shadow border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pemilik</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $ownerCount }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Receptionist Users -->
                <div class="bg-white rounded-xl p-6 shadow border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Resepsionis</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $receptionistCount }}</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Customer Users -->
                <div class="bg-white rounded-xl p-6 shadow border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pelanggan</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $customerCount }}</p>
                        </div>
                        <div class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
