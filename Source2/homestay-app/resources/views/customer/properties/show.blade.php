<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        {{-- Judul Properti --}}
        <h2 class="text-2xl font-bold text-gray-800 mb-4">{{ $property->name }}</h2>

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

        {{-- Deskripsi --}}
        <div class="bg-white p-4 rounded-lg shadow mb-6">
            <div class="mb-4">
                <label>Deskripsi</label>
                <p class="text-gray-700">{{ $property->description }}</p>
            </div>
            <div class="mb-4">
                <label>Lokasi</label>
                <p class="text-gray-700">{{ $property->location }}</p>
            </div>
            <div class="mb-4">
                <label>Fasilitas</label>
                <p class="text-gray-700">{{ $property->facilities }}</p>
            </div>

            <p class="mt-4 text-lg font-semibold text-green-700">
                Harga: <span class="text-black">Rp {{ number_format($property->price_per_night) }}</span> / malam
            </p>

            <button type="submit">
                <a href="{{ route('customer.reservations.create', $property->id) }}"
                    class="bg-green-500 text-white px-4 py-2 rounded mt-4 inline-block">
                    Pesan Sekarang
                </a>
        </div>

    </div>
</x-app-layout>
