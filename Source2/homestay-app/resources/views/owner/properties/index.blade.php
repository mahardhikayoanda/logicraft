@extends('layouts.owner')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Daftar Properti</h2>

    <a href="{{ route('owner.properties.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Properti</a>

    @if (session('success'))
        <div class="text-green-600 mt-4">{{ session('success') }}</div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
        @forelse($properties as $property)
            <div class="bg-white shadow rounded-lg overflow-hidden">
                @if ($property->images->count())
                    <img src="{{ asset('storage/' . $property->images->first()->image_path) }}" alt="{{ $property->name }}"
                        class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tidak ada gambar
                    </div>
                @endif

                <div class="p-4">
                    <h3 class="text-lg font-bold">{{ $property->name }}</h3>
                    <p class="text-gray-600 text-sm mt-1 mb-2">{{ Str::limit($property->description, 80) }}</p>
                    <p class="text-blue-600 font-semibold">Rp {{ number_format($property->price_per_night) }}</p>

                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('owner.properties.show', $property) }}"
                            class="text-sm text-yellow-600 hover:underline">Detail</a>

                        <form action="{{ route('owner.properties.destroy', $property) }}" method="POST"
                            onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-sm text-red-600 hover:underline">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500 py-8">
                Belum ada properti.
            </div>
        @endforelse
    </div>
@endsection
