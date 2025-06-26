@extends('layouts.customer')

@section('title', 'Tulis Ulasan')

@section('content')
    <h2 class="text-xl font-bold mb-4">Ulasan untuk {{ $reservation->property->name }}</h2>

    <form action="{{ route('customer.reviews.store', $reservation->id) }}" method="POST"
        class="bg-white p-6 rounded shadow max-w-xl">
        @csrf

        <div class="mb-4">
            <label for="rating" class="block font-semibold mb-2">Rating</label>
            <div id="star-rating" class="flex gap-1 text-2xl text-gray-300 cursor-pointer">
                @for ($i = 1; $i <= 5; $i++)
                    <span class="star" data-value="{{ $i }}">★</span>
                @endfor
            </div>
            <input type="hidden" name="rating" id="rating" value="{{ old('rating', 0) }}" required>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('#star-rating .star');
        const ratingInput = document.getElementById('rating');

        stars.forEach((star, index) => {
            star.addEventListener('click', () => {
                const value = star.getAttribute('data-value');
                ratingInput.value = value;

                // Update warna bintang
                stars.forEach((s, i) => {
                    s.classList.toggle('text-yellow-400', i < value);
                    s.classList.toggle('text-gray-300', i >= value);
                });
            });

            // Tambahkan hover (opsional)
            star.addEventListener('mouseover', () => {
                stars.forEach((s, i) => {
                    s.classList.toggle('text-yellow-200', i <= index);
                });
            });

            star.addEventListener('mouseout', () => {
                const currentRating = ratingInput.value;
                stars.forEach((s, i) => {
                    s.classList.remove('text-yellow-200');
                    s.classList.toggle('text-yellow-400', i < currentRating);
                    s.classList.toggle('text-gray-300', i >= currentRating);
                });
            });
        });
    });
</script>
