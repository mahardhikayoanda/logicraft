@extends('layouts.customer')

@section('title', 'Wishlist Saya')

@section('content')
    <div class="py-4 px-6">

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($wishlistedProperties->isEmpty())
            <p class="text-gray-600">Anda belum menambahkan properti ke wishlist.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($wishlistedProperties as $property)
                    <div class="border rounded shadow-sm p-4">
                        @if ($property->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="{{ $property->name }}"
                                class="w-full h-48 object-cover rounded mb-3">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded mb-3">
                                <span class="text-gray-500">Tidak ada gambar</span>
                            </div>
                        @endif

                        <h3 class="text-lg font-bold">{{ $property->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $property->location }}</p>
                        <p class="text-sm mb-2">Rp {{ number_format($property->price_per_night) }} / malam</p>

                        <div class="flex justify-between">
                            <a href="{{ route('customer.properties.show', $property->id) }}"
                                class="text-blue-600 hover:underline text-sm">Lihat</a>

                            <form method="POST" action="{{ route('customer.wishlist.destroy', $property->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:underline text-sm"
                                    onclick="return confirm('Hapus dari wishlist?')">Hapus</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
