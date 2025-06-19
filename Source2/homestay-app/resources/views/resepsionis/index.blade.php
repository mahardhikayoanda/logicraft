<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Daftar Properti</h2>
    </x-slot>

    <div class="py-4 px-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($properties as $property)
                <div class="border p-4 rounded shadow">
                    <h3 class="font-bold text-lg mb-2">{{ $property->name }}</h3>

                    @if($property->images->count())
                        <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                             alt="{{ $property->name }}" class="w-full h-40 object-cover rounded mb-2">
                    @endif

                    <p><strong>Lokasi:</strong> {{ $property->location }}</p>
                    <p><strong>Harga/Malam:</strong> Rp {{ number_format($property->price_per_night) }}</p>
                    <p><strong>Ketersediaan:</strong>
                        <span class="{{ $property->is_available ? 'text-green-600' : 'text-red-600' }}">
                            {{ $property->is_available ? 'Tersedia' : 'Tidak Tersedia' }}
                        </span>
                    </p>

                    <form action="{{ route('resepsionis.properties.updateAvailability', $property->id) }}"
                          method="POST" class="mt-3">
                        @csrf
                        @method('PUT')
                        <label class="flex items-center gap-2">
                            <input type="checkbox" name="is_available" {{ $property->is_available ? 'checked' : '' }}
                                   onchange="this.form.submit()">
                            <span>Ubah Status Ketersediaan</span>
                        </label>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
