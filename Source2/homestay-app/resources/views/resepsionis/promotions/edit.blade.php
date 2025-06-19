@extends('layouts.resepsionis')

@section('title', 'Edit Promosi')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-semibold mb-4">Edit Promosi</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('resepsionis.promotions.update', $promotion->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block font-semibold">Judul</label>
                <input type="text" name="title" value="{{ old('title', $promotion->title) }}"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label for="start_date" class="block font-semibold">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ old('start_date', $promotion->start_date) }}"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label for="end_date" class="block font-semibold">Tanggal Berakhir</label>
                <input type="date" name="end_date" value="{{ old('end_date', $promotion->end_date) }}"
                    class="w-full border rounded px-3 py-2 mt-1" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block font-semibold">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full border rounded px-3 py-2 mt-1">{{ old('description', $promotion->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label for="image" class="block font-semibold">Gambar (opsional)</label>
                @if ($promotion->image_path)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $promotion->image_path) }}" alt="Promo" class="h-32 rounded">
                    </div>
                @endif
                <input type="file" name="image" class="w-full border rounded px-3 py-2 mt-1">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('resepsionis.promotions.index') }}" class="mr-4 text-gray-600 hover:underline">Batal</a>
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
            </div>
        </form>
    </div>
@endsection
