@extends('layouts.customer')

@section('title', 'Jelajahi Properti')

@section('content')
    <div class="py-4">

        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('customer.properties.index') }}" class="mb-6">
            <input type="text" name="search" placeholder="Cari properti atau lokasi..." value="{{ request('search') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded shadow-sm focus:outline-none focus:ring focus:border-blue-400">
        </form>

        @if ($properties->isEmpty())
            <p class="text-gray-600">Tidak ada properti ditemukan.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($properties as $property)
                    <div class="border p-4 rounded shadow-sm bg-white">
                        {{-- Gambar Properti --}}
                        @if ($property->images->isNotEmpty() && file_exists(public_path('storage/' . $property->images->first()->image_path)))
                            <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                                alt="{{ $property->name }}" class="w-full h-64 object-cover rounded mb-3">
                        @else
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded mb-3">
                                <span class="text-gray-500">Tidak ada gambar</span>
                            </div>
                        @endif

                        {{-- Informasi Properti --}}
                        <h3 class="text-lg font-bold text-gray-800">{{ $property->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $property->location }}</p>
                        <p class="text-sm font-semibold text-green-700">Rp {{ number_format($property->price_per_night) }} /
                            malam</p>

                        {{-- Rating Bintang --}}
                        @php
                            $reviews = $property->reservations->pluck('review')->filter();
                            $avgRating = $reviews->avg('rating');
                        @endphp

                        @if ($avgRating)
                            <p class="text-yellow-500 text-sm mt-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span>{{ $i <= round($avgRating) ? '★' : '☆' }}</span>
                                @endfor
                                <span class="text-gray-600 text-xs ml-1">({{ number_format($avgRating, 1) }}/5)</span>
                            </p>
                        @else
                            <p class="text-gray-500 text-sm mt-1 italic">Belum ada ulasan</p>
                        @endif

                        {{-- Tombol --}}
                        <a href="{{ route('customer.properties.show', $property->id) }}"
                            class="inline-block mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">
                            Lihat Detail
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
