@extends('layouts.customer')

@section('title', 'Reservasi: ' . $property->name)

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Back Button -->
            <div class="flex justify-start mb-8">
                <a href="{{ route('guest.properties.show', $property->id) }}"
                    class="inline-flex items-center border-2 border-gray-200 hover:border-red-300 px-5 py-2.5 rounded-lg transition-all duration-200 group bg-white shadow-sm hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 mr-2 text-gray-600 group-hover:text-red-600 transition-transform group-hover:-translate-x-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-medium text-gray-700 group-hover:text-red-600">Kembali</span>
                </a>
            </div>

            <!-- Property Header -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-8">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Reservasi: {{ $property->name }}</h1>
                    <div class="flex items-center text-gray-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $property->location }}</span>
                    </div>
                </div>

                <div class="flex flex-col items-end">
                    <div class="flex items-end">
                        <span
                            class="text-2xl font-bold text-red-600">Rp{{ number_format($property->price_per_night, 0, ',', '.') }}</span>
                        <span class="text-gray-500 ml-1">/malam</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-8">
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                <h2 class="text-xl font-bold text-white">Formulir Reservasi</h2>
                <p class="text-red-100 text-sm">Isi data diri dengan benar</p>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <form method="POST" action="{{ route('customer.reservations.store', $property->id) }}">
                    @csrf

                    <!-- Hidden fields for dates -->
                    <input type="hidden" name="check_in_date" value="{{ request('check_in_date') }}">
                    <input type="hidden" name="check_out_date" value="{{ request('check_out_date') }}">

                    <!-- Form Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Lengkap -->
                        <div class="col-span-1">
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap
                                Sesuai KTP</label>
                            <input type="text" name="nama_lengkap" id="nama_lengkap"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                value="{{ old('nama_lengkap', auth()->user()?->name) }}" required>
                            @error('nama_lengkap')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-span-1">
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                value="{{ old('email', auth()->user()?->email) }}" required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nomor HP -->
                        <div class="col-span-1">
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                            <input type="tel" name="no_hp" id="no_hp"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah Tamu -->
                        <div class="col-span-1">
                            <label for="jumlah_tamu" class="block text-sm font-medium text-gray-700 mb-1">Jumlah
                                Tamu</label>
                            <input type="number" name="jumlah_tamu" id="jumlah_tamu" min="1"
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                value="{{ old('jumlah_tamu', 1) }}" required>
                            @error('jumlah_tamu')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Check-in Date (Display Only) -->
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Check-in</label>
                            <div class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50">
                                {{ \Carbon\Carbon::parse(request('check_in_date'))->translatedFormat('l, d F Y') }}
                            </div>
                        </div>

                        <!-- Check-out Date (Display Only) -->
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Check-out</label>
                            <div class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50">
                                {{ \Carbon\Carbon::parse(request('check_out_date'))->translatedFormat('l, d F Y') }}
                            </div>
                        </div>

                        <!-- Total Malam -->
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Malam</label>
                            <div class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50">
                                {{ \Carbon\Carbon::parse(request('check_in_date'))->diffInDays(\Carbon\Carbon::parse(request('check_out_date'))) }}
                                Malam
                            </div>
                        </div>

                        <!-- Total Harga -->
                        <div class="col-span-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Total Pembayaran</label>
                            <div
                                class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 font-bold text-red-600">
                                Rp{{ number_format($property->price_per_night * \Carbon\Carbon::parse(request('check_in_date'))->diffInDays(\Carbon\Carbon::parse(request('check_out_date'))), 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-bold py-4 px-6 rounded-lg shadow-lg transition-all duration-300">
                            Konfirmasi Pemesanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
