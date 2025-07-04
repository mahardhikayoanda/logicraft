@extends('layouts.resepsionis')

@section('title', 'Dashboard Resepsionis')
@section('header', 'Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Welcome Card -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 border border-blue-100">
        <div class="flex items-center">
            <div class="bg-blue-100 p-3 rounded-full mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Selamat datang, {{ Auth::user()->name }}</h1>
                <p class="text-gray-600">Anda login sebagai Resepsionis</p>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Today's Check-ins -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Check-in Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $confirmedReservations }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('resepsionis.reservations.index', ['status' => 'checked_in']) }}" class="inline-block mt-3 text-sm text-blue-600 hover:text-blue-800">Lihat detail →</a>
        </div>

        <!-- Pending Reservations -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Reservasi Pending</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $pendingReservations }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('resepsionis.reservations.index', ['status' => 'pending']) }}" class="inline-block mt-3 text-sm text-blue-600 hover:text-blue-800">Lihat detail →</a>
        </div>

        <!-- Today's Check-outs -->
        <div class="bg-white rounded-lg shadow-md p-6 border-t-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Check-out Hari Ini</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $canceledReservations }}</p>
                </div>
                <div class="bg-green-100 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 17l-4 4m0 0l-4-4m4 4V3" />
                    </svg>
                </div>
            </div>
            <a href="{{ route('resepsionis.reservations.index', ['status' => 'checked_out']) }}" class="inline-block mt-3 text-sm text-blue-600 hover:text-blue-800">Lihat detail →</a>
        </div>
    </div>

    <!-- Recent Reservations -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Reservasi Terbaru</h2>
            <a href="{{ route('resepsionis.reservations.index') }}" class="text-sm text-blue-600 hover:text-blue-800">Lihat semua →</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Tamu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Properti</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentReservations as $reservation)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $reservation->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reservation->customer->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reservation->property->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('d M Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusClasses = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'confirmed' => 'bg-blue-100 text-blue-800',
                                    'cancelled' => 'bg-red-100 text-red-800'
                                ];
                            @endphp
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$reservation->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($reservation->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada reservasi terbaru</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
