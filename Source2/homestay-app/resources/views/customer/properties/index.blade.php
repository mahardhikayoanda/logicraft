<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Daftar Properti</h2>
    </x-slot>

    <div class="p-4">
        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('customer.properties.index') }}" class="mb-4">
            <input type="text" name="search" placeholder="Cari properti atau lokasi..." value="{{ request('search') }}"
                class="w-full border px-3 py-2 rounded">
        </form>

        @if ($properties->isEmpty())
            <p>Tidak ada properti ditemukan.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($properties as $property)
                    <div class="border p-4 rounded shadow-sm">
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
                        <a href="{{ route('customer.properties.show', $property->id) }}"
                            class="inline-block mt-2 bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                            Detail
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
