@extends('layouts.customer')

@section('title', 'Tulis Ulasan')

@section('content')
    <h2 class="text-xl font-bold mb-4">Ulasan untuk {{ $reservation->property->name }}</h2>

    <form action="{{ route('customer.reviews.store', $reservation->id) }}" method="POST"
        class="bg-white p-6 rounded shadow max-w-xl">
        @csrf

        <div class="mb-4">
            <label for="rating" class="block font-semibold">Rating (1-5)</label>
            <input type="number" name="rating" id="rating" min="1" max="5" value="{{ old('rating') }}"
                class="w-full border p-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="comment" class="block font-semibold">Komentar (Opsional)</label>
            <textarea name="comment" id="comment" rows="4" class="w-full border p-2 rounded">{{ old('comment') }}</textarea>
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
            Kirim Ulasan
        </button>
    </form>
@endsection
