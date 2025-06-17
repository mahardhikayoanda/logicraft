<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Tambah Properti</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form action="{{ route('owner.properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label>Nama Properti</label>
                <input name="name" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Deskripsi</label>
                <textarea name="description" class="w-full border px-3 py-2" required></textarea>
            </div>

            <div class="mb-4">
                <label>Harga per malam</label>
                <input type="number" name="price_per_night" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Alamat</label>
                <input name="location" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Fasilitas</label>
                <input name="facilities" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Upload Gambar (bisa lebih dari satu)</label>
                <input type="file" name="images[]" multiple class="w-full border px-3 py-2">
            </div>


            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('owner.properties.index') }}" class="text-gray-700 ml-4">Batal</a>
        </form>
    </div>
</x-app-layout>
