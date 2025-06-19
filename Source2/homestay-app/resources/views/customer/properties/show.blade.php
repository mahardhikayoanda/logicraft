@extends('layouts.customer')

@section('title', $property->name)

@section('content')
    <div class="max-w-4xl mx-auto p-4"> 

        {{-- Gambar Properti --}}
        @if ($property->images->count())
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                @foreach ($property->images as $image)
                    <div class="overflow-hidden rounded-xl shadow-md">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gambar Properti"
                            class="w-full h-40 object-cover transition-transform duration-300 hover:scale-105">
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Deskripsi Properti --}}
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <div class="mb-4">
                <label class="font-semibold text-gray-600">Deskripsi</label>
                <p class="text-gray-700">{{ $property->description }}</p>
            </div>
            <div class="mb-4">
                <label class="font-semibold text-gray-600">Lokasi</label>
                <p class="text-gray-700">{{ $property->location }}</p>
            </div>
            <div class="mb-4">
                <label class="font-semibold text-gray-600">Fasilitas</label>
                <p class="text-gray-700">{{ $property->facilities }}</p>
            </div>
            <div class="mb-4">
                <label class="font-semibold text-gray-600">Harga per malam</label>
                <p class="text-green-700 font-semibold">Rp {{ number_format($property->price_per_night) }}</p>
            </div>
        </div>

        {{-- Form Cek Ketersediaan --}}
        <form method="GET" action="" class="bg-white p-4 rounded-lg shadow mb-6">
            <h3 class="text-lg font-bold mb-4 text-gray-700">Cek Ketersediaan</h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="check_in_date" class="block text-sm font-medium text-gray-700">Tanggal Check-in</label>
                    <input type="date" id="check_in_date" name="check_in_date" value="{{ request('check_in_date') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div>
                    <label for="check_out_date" class="block text-sm font-medium text-gray-700">Tanggal Check-out</label>
                    <input type="date" id="check_out_date" name="check_out_date" value="{{ request('check_out_date') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 hover:bg-blue-600">
                Cek Ketersediaan
            </button>
        </form>

        {{-- Logika untuk Menentukan Ketersediaan --}}
        @php
            $isBooked = false;
            if (request()->filled('check_in_date') && request()->filled('check_out_date')) {
                $checkIn = request('check_in_date');
                $checkOut = request('check_out_date');
                $isBooked = $property->isBookedOn($checkIn, $checkOut);
            }
        @endphp

        {{-- Tampilkan Tombol atau Pesan --}}
        @if (request()->filled('check_in_date') && request()->filled('check_out_date'))
            @if (!$isBooked)
                <a href="{{ route('customer.reservations.create', [
                    'property' => $property->id,
                    'check_in_date' => request('check_in_date'),
                    'check_out_date' => request('check_out_date'),
                ]) }}"
                    class="bg-green-500 text-white px-4 py-2 rounded inline-block hover:bg-green-600">
                    Pesan Sekarang
                </a>
            @else
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded">
                    Properti tidak tersedia pada tanggal tersebut.
                </div>
            @endif
        @endif
    </div>
@endsection
