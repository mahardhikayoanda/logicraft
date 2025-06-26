@extends('layouts.customer')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded shadow p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Reservasi</h3>
                <p class="text-3xl text-blue-600 font-bold">{{ $totalReservations }}</p>
            </div>

            <div class="bg-white rounded shadow p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Reservasi Mendatang</h3>
                <p class="text-3xl text-green-600 font-bold">{{ $upcomingReservations }}</p>
            </div>

            <div class="bg-white rounded shadow p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Lihat Semua Properti</h3>
                <a href="{{ route('customer.properties.index') }}"
                    class="inline-block mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Jelajahi
                </a>
            </div>
        </div>
    </div>

    <!-- Section Promosi -->
    <section class="my-6">
        <h2 class="text-xl font-semibold mb-4">Promosi Aktif</h2>

        @if ($promotions->isEmpty())
            <p class="text-gray-500">Tidak ada promosi saat ini.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($promotions as $promo)
                    <div class="bg-white rounded shadow p-4">
                        @if ($promo->image_path)
                            <img src="{{ asset('storage/' . $promo->image_path) }}"
                                class="w-full h-40 object-cover rounded mb-3" alt="{{ $promo->title }}">
                        @endif
                        <h3 class="text-lg font-bold">{{ $promo->title }}</h3>
                        <p class="text-sm text-gray-600 mb-1">
                            {{ $promo->start_date }} s/d {{ $promo->end_date }}
                        </p>
                        <p class="text-sm text-gray-700">{{ $promo->description }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    <!-- Section Properti -->
    <div class="mb-6">
        <form method="GET" action="{{ route('customer.properties.index') }}" class="mb-6">
            <input type="text" name="search" placeholder="Cari properti atau lokasi..." value="{{ request('search') }}"
                class="w-full border border-gray-300 px-4 py-2 rounded shadow-sm focus:outline-none focus:ring focus:border-blue-400">
        </form>

        @if ($properties->isEmpty())
            <p class="text-gray-600">Tidak ada properti ditemukan.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($properties as $property)
                    <div class="border p-4 rounded shadow-sm bg-white">
                        @if ($property->images->isNotEmpty() && file_exists(public_path('storage/' . $property->images->first()->image_path)))
                            <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                                alt="{{ $property->name }}" class="w-full h-64 object-cover rounded mb-4">
                        @else
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded mb-4">
                                <span class="text-gray-500">Tidak ada gambar</span>
                            </div>
                        @endif

                        <h3 class="text-lg font-bold">{{ $property->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $property->location }}</p>
                        <p class="text-sm">Rp. {{ number_format($property->price_per_night) }} / malam</p>

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

                        <a href="{{ route('customer.properties.show', $property->id) }}"
                            class="inline-block mt-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                            Detail
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
