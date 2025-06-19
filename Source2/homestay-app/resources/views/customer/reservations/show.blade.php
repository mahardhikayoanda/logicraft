@extends('layouts.customer')

@section('title', 'Detail Pesanan')

@section('content')
    <div class="py-4 px-6">
        <div class="bg-white rounded shadow p-4">

            {{-- Nama Properti --}}
            <h3 class="text-lg font-bold mb-2">{{ $reservation->property->name }}</h3>

            {{-- Gambar Properti --}}
            @if ($reservation->property->images->isNotEmpty())
                <img src="{{ asset('storage/' . $reservation->property->images->first()->image_path) }}" alt="Gambar Properti"
                    class="w-full h-64 object-cover rounded mb-4">
            @endif

            {{-- Informasi Pemesan --}}
            <div class="mb-4">
                <p><strong>Nama Pemesan:</strong> {{ $reservation->nama_lengkap }}</p>
                <p><strong>Email:</strong> {{ $reservation->email }}</p>
                <p><strong>No. HP:</strong> {{ $reservation->no_hp }}</p>
            </div>

            {{-- Informasi Properti & Reservasi --}}
            <div class="mb-4">
                <p><strong>Alamat:</strong> {{ $reservation->property->location }}</p>
                <p><strong>Harga per malam:</strong> Rp {{ number_format($reservation->property->price_per_night) }}</p>
                <p><strong>Check-in:</strong> {{ $reservation->check_in_date }}</p>
                <p><strong>Check-out:</strong> {{ $reservation->check_out_date }}</p>
                <p><strong>Jumlah Tamu:</strong> {{ $reservation->jumlah_tamu }}</p>
                <p><strong>Total Harga:</strong> Rp {{ number_format($reservation->total_price) }}</p>
            </div>

            {{-- Status Reservasi --}}
            <p>
                <strong>Status:</strong>
                <span
                    class="uppercase font-semibold text-sm
                    {{ match ($reservation->status) {
                        'pending' => 'text-yellow-600',
                        'confirmed' => 'text-blue-600',
                        'checked_in' => 'text-green-600',
                        'canceled' => 'text-red-600',
                        default => 'text-gray-600',
                    } }}">
                    {{ $reservation->status }}
                </span>
            </p>
        </div>

        {{-- Tombol Kembali --}}
        <div class="mt-6">
            <a href="{{ route('customer.reservations.history') }}" class="text-blue-500 hover:underline">
                &larr; Kembali ke Riwayat
            </a>
        </div>
    </div>
@endsection
