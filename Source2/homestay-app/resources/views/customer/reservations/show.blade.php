@extends('layouts.customer')

@section('title', 'Detail Reservasi')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Header Section -->
        <div class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Detail Reservasi</h1>
                    </div>
                    <!-- Tombol Kembali yang Diperbarui -->
                    <a href="{{ route('customer.reservations.history') }}"
                        class="inline-flex items-center border-2 border-gray-200 hover:border-red-300 px-5 py-2 rounded-lg transition-all duration-200 group bg-white shadow-sm hover:shadow-md">
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
            </div>
        </div>


        <!-- Main Content -->
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <!-- Header with Status -->
                <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                    <div class="flex justify-between items-center">
                        <div>
                            <h2 class="text-xl font-bold text-white">Detail Reservasi</h2>
                            <p class="text-red-100 text-sm">{{ $reservation->property->name }}</p>
                        </div>
                        <span
                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white
                            {{ match ($reservation->status) {
                                'pending' => 'text-yellow-600',
                                'confirmed' => 'text-blue-600',
                                'checked_in' => 'text-green-600',
                                'canceled' => 'text-red-600',
                                default => 'text-gray-600',
                            } }}">
                            {{ ucfirst($reservation->status) }}
                        </span>
                    </div>
                </div>

                <!-- Content Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
                    <!-- Left Column - Property Info -->
                    <div class="md:col-span-1 p-6 border-b md:border-b-0 md:border-r border-gray-200">
                        <h3 class="font-medium text-gray-900 mb-4">Informasi Properti</h3>

                        @if ($reservation->property->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $reservation->property->images->first()->image_path) }}"
                                alt="{{ $reservation->property->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                        @endif

                        <h4 class="font-bold text-gray-800">{{ $reservation->property->name }}</h4>
                        <div class="flex items-center text-sm text-gray-500 mt-1 mb-3">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $reservation->property->location }}
                        </div>

                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Harga per malam:</p>
                            <p class="text-lg font-semibold">Rp
                                {{ number_format($reservation->property->price_per_night, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <!-- Middle Column - Reservation Details -->
                    <div class="md:col-span-1 p-6 border-b md:border-b-0 md:border-r border-gray-200">
                        <h3 class="font-medium text-gray-900 mb-4">Detail Reservasi</h3>

                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Tanggal Check-in</p>
                                <p class="font-medium">
                                    {{ \Carbon\Carbon::parse($reservation->check_in_date)->translatedFormat('l, d F Y') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Tanggal Check-out</p>
                                <p class="font-medium">
                                    {{ \Carbon\Carbon::parse($reservation->check_out_date)->translatedFormat('l, d F Y') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Durasi Menginap</p>
                                <p class="font-medium">
                                    {{ \Carbon\Carbon::parse($reservation->check_in_date)->diffInDays(\Carbon\Carbon::parse($reservation->check_out_date)) }}
                                    Malam
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Jumlah Tamu</p>
                                <p class="font-medium">{{ $reservation->jumlah_tamu }} Orang</p>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Customer & Payment Info -->
                    <div class="md:col-span-1 p-6">
                        <h3 class="font-medium text-gray-900 mb-4">Informasi Pemesan</h3>

                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Nama Pemesan</p>
                                <p class="font-medium">{{ $reservation->nama_lengkap }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="font-medium">{{ $reservation->email }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-500">Nomor Telepon</p>
                                <p class="font-medium">{{ $reservation->no_hp }}</p>
                            </div>
                        </div>

                        <div class="mt-8 pt-4 border-t border-gray-200">
                            <h3 class="font-medium text-gray-900 mb-4">Rincian Pembayaran</h3>

                            <div class="space-y-2">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Subtotal</span>
                                    <span class="text-sm">Rp
                                        {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Biaya Layanan</span>
                                    <span class="text-sm">Rp 0</span>
                                </div>
                                <div class="border-t border-gray-200 my-2"></div>
                                <div class="flex justify-between">
                                    <span class="font-semibold">Total Pembayaran</span>
                                    <span class="font-bold text-red-600">Rp
                                        {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            @if ($reservation->status === 'pending')
                                <div class="mt-6">
                                    <button id="pay-button"
                                        class="w-full bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-medium py-3 px-4 rounded-lg shadow-md transition duration-200">
                                        Bayar Sekarang
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($reservation->status === 'pending')
        <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('services.midtrans.client_key') }}"></script>
        <script>
            document.getElementById('pay-button').addEventListener('click', function() {
                snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result) {
                        window.location.href =
                            "{{ route('customer.reservations.callback', $reservation->id) }}" +
                            "?result=" + encodeURIComponent(JSON.stringify(result));
                    },
                    onPending: function(result) {
                        alert('Pembayaran tertunda: ' + result.status_message);
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal: ' + result.status_message);
                    }
                });
            });
        </script>
    @endif
@endsection
