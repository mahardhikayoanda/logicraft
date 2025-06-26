@extends('layouts.guest') {{-- Pastikan kamu punya layouts.guest, atau ganti sesuai layoutmu --}}

@section('title', 'Detail Properti')

@section('content')
    <div class="max-w-5xl mx-auto py-8 px-4">
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-2xl font-bold mb-4">{{ $property->name }}</h2>

            {{-- Gambar utama --}}
            @if ($property->images->isNotEmpty())
                <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                    class="w-full h-64 object-cover rounded mb-4" alt="Gambar Properti">
            @else
                <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded mb-4">
                    <span class="text-gray-500">Tidak ada gambar</span>
                </div>
            @endif

            {{-- Detail properti --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <p><strong>Lokasi:</strong> {{ $property->location }}</p>
                    <p><strong>Harga per malam:</strong> Rp {{ number_format($property->price_per_night, 0, ',', '.') }}</p>
                    <p><strong>Fasilitas:</strong> {{ $property->facilities }}</p>
                </div>
                <div>
                    <p>
                        <strong>Status Ketersediaan:</strong>
                        @if ($property->is_available)
                            <span class="text-green-600 font-semibold">Tersedia</span>
                        @else
                            <span class="text-red-600 font-semibold">Sudah dipesan</span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- Galeri tambahan --}}
            @if ($property->images->count() > 1)
                <h3 class="text-lg font-semibold mb-2">Foto Lainnya:</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($property->images->skip(1) as $img)
                        <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-40 object-cover rounded"
                            alt="Foto Tambahan">
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-6">
            <a href="{{ route('guest.properties.index') }}" class="text-blue-600 hover:underline">← Kembali ke Daftar Properti</a>
        </div>
    </div>
@endsection
