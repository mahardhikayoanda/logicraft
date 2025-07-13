@extends('layouts.customer')

@section('title', 'Tulis Ulasan')

@section('content')
    <div class="max-w-2xl mx-auto p-4">
        <div class="bg-white rounded-xl shadow-md overflow-hidden p-6">
            <div class="flex items-center mb-6">
                @if ($reservation->property->images->first())
                    <img src="{{ asset('storage/' . $reservation->property->images->first()->image_path) }}"
                        alt="{{ $reservation->property->name }}" class="w-20 h-20 object-cover rounded-lg mr-4">
                @endif
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Ulasan untuk {{ $reservation->property->name }}</h2>
                    <p class="text-gray-600">{{ $reservation->property->location }}</p>
                </div>
            </div>

            <form action="{{ route('customer.reviews.store', $reservation->id) }}" method="POST" id="reviewForm">
                @csrf

                <div class="mb-8">
                    <label class="block text-lg font-semibold text-gray-700 mb-3">Bagaimana pengalaman Anda?</label>
                    <div class="flex items-center mb-2">
                        <div id="star-rating" class="flex gap-1">
                            @for ($i = 1; $i <= 5; $i++)
                                <span
                                    class="star w-8 h-8 cursor-pointer text-4xl
                                    @if (old('rating', 0) >= $i) text-yellow-400 @else text-gray-300 @endif"
                                    data-value="{{ $i }}">★</span>
                            @endfor
                        </div>
                        <span id="rating-text" class="ml-2 text-gray-600 font-medium">
                            @switch(old('rating', 0))
                                @case(1)
                                    Buruk
                                @break

                                @case(2)
                                    Cukup
                                @break

                                @case(3)
                                    Baik
                                @break

                                @case(4)
                                    Sangat Baik
                                @break

                                @case(5)
                                    Luar Biasa
                                @break
                            @endswitch
                        </span>
                    </div>
                    <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', 0) }}" required>
                    @error('rating')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-8">
                    <label for="comment" class="block text-lg font-semibold text-gray-700 mb-3">Tambahkan komentar
                        (opsional)</label>
                    <textarea name="comment" id="comment" rows="5"
                        class="w-full border border-gray-300 rounded-lg p-4 focus:ring-2 focus:ring-green-500 focus:border-transparent transition-all"
                        placeholder="Bagikan pengalaman Anda menginap di tempat ini...">{{ old('comment') }}</textarea>
                    @error('comment')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ url()->previous() }}"
                        class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 rounded-lg font-medium text-white shadow-sm transition-colors">
                        Kirim Ulasan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating-input');
            const ratingText = document.getElementById('rating-text');

            const ratingDescriptions = {
                1: "Buruk",
                2: "Cukup",
                3: "Baik",
                4: "Sangat Baik",
                5: "Luar Biasa"
            };

            // Initialize from old input
            if (ratingInput.value > 0) {
                updateRatingDisplay(ratingInput.value);
            }

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-value');
                    ratingInput.value = rating;
                    updateRatingDisplay(rating);
                    console.log('Rating selected:', rating);
                });

                star.addEventListener('mouseover', function() {
                    const rating = this.getAttribute('data-value');
                    highlightStars(rating);
                });

                star.addEventListener('mouseout', function() {
                    highlightStars(ratingInput.value);
                });
            });

            function highlightStars(rating) {
                stars.forEach(star => {
                    const starValue = star.getAttribute('data-value');
                    if (starValue <= rating) {
                        star.classList.add('text-yellow-400');
                        star.classList.remove('text-gray-300');
                    } else {
                        star.classList.add('text-gray-300');
                        star.classList.remove('text-yellow-400');
                    }
                });
            }

            function updateRatingDisplay(rating) {
                highlightStars(rating);
                ratingText.textContent = ratingDescriptions[rating] || '';
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        .star {
            transition: all 0.2s ease;
            display: inline-block;
        }

        .star:hover {
            transform: scale(1.1);
        }
    </style>
@endpush
