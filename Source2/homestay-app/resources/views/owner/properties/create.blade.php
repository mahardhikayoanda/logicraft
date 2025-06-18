@extends('layouts.owner')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Tambah Properti</h2>

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

        <div class="flex gap-4 mt-6">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('owner.properties.index') }}" class="text-gray-700">Batal</a>
        </div>
    </form>
@endsection
