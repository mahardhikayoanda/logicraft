<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Properti</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form action="{{ route('owner.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
                    <ul class="text-sm list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mb-4">
                <label>Nama Properti</label>
                <input type="text" name="name" value="{{ old('name', $property->name) }}"
                    class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Deskripsi</label>
                <textarea name="description" class="w-full border px-3 py-2" required>{{ old('description', $property->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label>Harga per malam</label>
                <input type="number" name="price_per_night"
                    value="{{ old('price_per_night', $property->price_per_night) }}" class="w-full border px-3 py-2"
                    required>
            </div>

            <div class="mb-4">
                <label>Alamat</label>
                <input type="text" name="location" value="{{ old('location', $property->location) }}"
                    class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Fasilitas</label>
                <input type="text" name="facilities" value="{{ old('facilities', $property->facilities) }}"
                    class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Upload Gambar Baru</label>
                <input type="file" name="images[]" multiple class="w-full">
            </div>

            <div class="flex items-center gap-4 mb-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                <a href="{{ route('owner.properties.index') }}" class="text-gray-700">Batal</a>
            </div>
        </form>

        @if ($property->images->count())
            <div class="mb-4">
                <label class="block font-semibold mb-2">Gambar Saat Ini:</label>
                <div class="grid grid-cols-3 gap-4 mt-2">
                    @foreach ($property->images as $image)
                        <div class="relative">
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                class="w-full h-32 object-cover rounded">
                            <form action="{{ route('owner.properties.images.destroy', $image->id) }}" method="POST"
                                class="absolute top-1 right-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Hapus gambar ini?')"
                                    class="bg-red-500 text-white text-xs px-2 py-1 rounded">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
