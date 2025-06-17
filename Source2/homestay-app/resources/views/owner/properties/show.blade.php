<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Detail Properti</h2>
    </x-slot>

    <div class="py-4 px-6">
        <div class="mb-4">
            <h3 class="text-2xl font-bold mb-2">{{ $property->name }}</h3>
            <p class="text-gray-700">{{ $property->description }}</p>
        </div>

        <div class="mb-4">
            <p><strong>Lokasi:</strong> {{ $property->location }}</p>
            <p><strong>Harga per malam:</strong> Rp{{ number_format($property->price_per_night, 0, ',', '.') }}</p>
            <p><strong>Fasilitas:</strong> {{ $property->facilities }}</p>
        </div>

        @if ($property->images->count())
            <div class="mb-4">
                <p class="font-semibold mb-2">Gambar Properti:</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($property->images as $image)
                        <div>
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gambar Properti"
                                class="w-full h-40 object-cover rounded">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('owner.properties.edit', $property->id) }}"
                class="bg-yellow-500 text-white px-4 py-2 rounded mr-2">Edit</a>
            <a href="{{ route('owner.properties.index') }}"
                class="bg-gray-300 text-gray-800 px-4 py-2 rounded">Kembali</a>
        </div>
    </div>
</x-app-layout>
