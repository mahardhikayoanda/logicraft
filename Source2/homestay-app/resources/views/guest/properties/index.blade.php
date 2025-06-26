@extends('layouts.guest')

@section('title', 'Landing Page | LalokSumbar')

@section('content')
    <div class="mb-6">
        {{-- Hero Section --}}
        <div class="bg-cover bg-center h-96 flex items-center justify-center text-white"
            style="background-image: url('/images/hero.jpg')">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-2">Temukan Penginapan Anda</h1>
                <p class="text-lg">Sekitar Sumatera Barat, mudah & cepat</p>
            </div>
        </div>

        {{-- Promosi --}}
        <section class="my-10">
            <h2 class="text-2xl font-semibold mb-4 text-center">Promosi Aktif</h2>
            @if ($promotions->isEmpty())
                <p class="text-center text-gray-500">Tidak ada promosi saat ini.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($promotions as $promo)
                        <div class="bg-white shadow p-4 rounded">
                            @if ($promo->image_path)
                                <img src="{{ asset('storage/' . $promo->image_path) }}"
                                    class="h-40 w-full object-cover mb-2 rounded">
                            @endif
                            <h3 class="font-bold text-lg">{{ $promo->title }}</h3>
                            <p class="text-sm text-gray-600">{{ $promo->start_date }} - {{ $promo->end_date }}</p>
                            <p class="text-sm text-gray-700">{{ $promo->description }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- Properti --}}
        <section class="my-10">
            <h2 class="text-2xl font-semibold mb-4 text-center">Dekat dari Jam Gadang</h2>
            @if ($properties->isEmpty())
                <p class="text-center text-gray-500">Tidak ada properti tersedia saat ini.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach ($properties as $property)
                        <div class="bg-white shadow p-4 rounded">
                            @if ($property->images->isNotEmpty())
                                <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                                    class="h-40 w-full object-cover rounded mb-3">
                            @endif
                            <h3 class="text-lg font-bold">{{ $property->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $property->location }}</p>
                            <p class="text-sm">Rp. {{ number_format($property->price_per_night) }} / malam</p>
                            <a href="{{ route('guest.properties.show', $property->id) }}"
                                class="inline-block mt-2 text-blue-600 hover:underline text-sm">
                                Lihat Detail
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
@endsection
