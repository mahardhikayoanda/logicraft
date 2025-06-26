@extends('layouts.guest')

@section('title', 'Daftar Properti')

@section('content')
    <form method="GET" class="mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari properti atau lokasi..."
            class="w-full px-4 py-2 border rounded">
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse ($properties as $property)
            <div class="bg-white p-4 rounded shadow">
                @if ($property->images->isNotEmpty())
                    <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                        class="h-40 w-full object-cover mb-2 rounded">
                @endif

                <h3 class="text-lg font-bold">{{ $property->name }}</h3>
                <p class="text-sm text-gray-600">{{ $property->location }}</p>
                <p class="text-sm">Rp. {{ number_format($property->price_per_night) }} / malam</p>

                <a href="{{ route('guest.properties.show', $property->id) }}"
                    class="inline-block mt-2 px-3 py-1 bg-blue-500 text-white rounded text-sm">Lihat Detail</a>
            </div>
        @empty
            <p>Tidak ada properti tersedia.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $properties->links() }}
    </div>
@endsection
