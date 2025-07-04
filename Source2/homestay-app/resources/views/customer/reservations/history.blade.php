@extends('layouts.customer')

@section('title', 'Riwayat Reservasi Saya')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8">
            <div class="mb-6 md:mb-8">
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">Riwayat Reservasi Saya</h1>
                <p class="text-sm md:text-base text-gray-600 mt-1 md:mt-2">Daftar semua reservasi yang pernah Anda buat</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-8 py-4 md:py-8">
        @if (session('success'))
            <div
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 md:p-4 rounded mb-6 md:mb-8 text-sm md:text-base">
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if ($reservations->isEmpty())
            <div
                class="text-center py-8 md:py-12 bg-white rounded-lg md:rounded-xl shadow-sm border border-gray-200 mx-2 md:mx-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 md:h-12 md:w-12 mx-auto text-gray-400"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <h3 class="mt-3 md:mt-4 text-base md:text-lg font-medium text-gray-900">Belum ada reservasi</h3>
                <p class="mt-1 text-xs md:text-sm text-gray-500">Anda belum memiliki riwayat reservasi.</p>
                <div class="mt-4 md:mt-6">
                    <a href="{{ route('customer.properties.index') }}"
                        class="inline-flex items-center px-3 py-1.5 md:px-4 md:py-2 border border-transparent text-xs md:text-sm font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600">
                        Cari Penginapan
                    </a>
                </div>
            </div>
        @else
            <div class="bg-white shadow overflow-hidden rounded-lg md:rounded-xl mx-2 md:mx-0">
                <!-- Filter Tabs -->
                <div class="border-b border-gray-200 overflow-x-auto">
                    <nav class="flex whitespace-nowrap px-2 md:px-0">
                        <a href="{{ route('customer.reservations.history') }}"
                            class="{{ request()->is('customer/reservations') ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} py-3 px-3 md:px-6 border-b-2 font-medium text-xs md:text-sm">
                            Semua
                        </a>
                        <a href="{{ route('customer.reservations.history', ['status' => 'pending']) }}"
                            class="{{ request('status') == 'pending' ? 'border-yellow-500 text-yellow-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} py-3 px-3 md:px-6 border-b-2 font-medium text-xs md:text-sm">
                            Menunggu
                        </a>
                        <a href="{{ route('customer.reservations.history', ['status' => 'confirmed']) }}"
                            class="{{ request('status') == 'confirmed' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} py-3 px-3 md:px-6 border-b-2 font-medium text-xs md:text-sm">
                            Dikonfirmasi
                        </a>
                        <a href="{{ route('customer.reservations.history', ['status' => 'canceled']) }}"
                            class="{{ request('status') == 'canceled' ? 'border-red-500 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} py-3 px-3 md:px-6 border-b-2 font-medium text-xs md:text-sm">
                            Dibatalkan
                        </a>
                    </nav>
                </div>

                <!-- Reservation List -->
                <ul class="divide-y divide-gray-200">
                    @foreach ($reservations as $reservation)
                        <li class="p-4 md:p-6 hover:bg-gray-50 transition-colors duration-150">
                            <!-- Property Info -->
                            <div class="flex items-start space-x-3 md:space-x-4 mb-3">
                                @if ($reservation->property->images->isNotEmpty())
                                    <div class="flex-shrink-0">
                                        <img class="h-12 w-12 md:h-16 md:w-16 rounded-lg object-cover"
                                            src="{{ asset('storage/' . $reservation->property->images->first()->image_path) }}"
                                            alt="{{ $reservation->property->name }}">
                                    </div>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-sm md:text-base font-medium text-gray-900 truncate">
                                        {{ $reservation->property->name }}</h3>
                                    <p class="text-xs md:text-sm text-gray-500 flex items-center mt-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 md:h-4 md:w-4 mr-1"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ Str::limit($reservation->property->location, 30) }}
                                    </p>
                                </div>
                            </div>

                            <!-- Reservation Details -->
                            <div class="grid grid-cols-2 gap-y-2 gap-x-4 text-xs md:text-sm mb-3">
                                <div>
                                    <p class="text-gray-500">Check-in</p>
                                    <p class="font-medium">
                                        {{ \Carbon\Carbon::parse($reservation->check_in_date)->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Check-out</p>
                                    <p class="font-medium">
                                        {{ \Carbon\Carbon::parse($reservation->check_out_date)->translatedFormat('d M Y') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Total</p>
                                    <p class="font-medium text-red-600">Rp
                                        {{ number_format($reservation->total_price, 0, ',', '.') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Status</p>
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xxs md:text-xs font-medium
                                        {{ match ($reservation->status) {
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'confirmed' => 'bg-blue-100 text-blue-800',
                                            'canceled' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800',
                                        } }}">
                                        {{ ucfirst($reservation->status) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="mt-3 flex flex-wrap gap-2">
                                @if ($reservation->status === 'pending')
                                    <a href="{{ route('customer.reservations.show', $reservation->id) }}"
                                        class="inline-flex items-center px-2.5 py-1 border border-transparent text-xxs md:text-xs font-medium rounded shadow-sm text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600">
                                        Bayar
                                    </a>

                                    <a href="{{ route('customer.reservations.edit', $reservation->id) }}"
                                        class="inline-flex items-center px-2.5 py-1 border border-gray-300 shadow-sm text-xxs md:text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                        Edit
                                    </a>

                                    <form action="{{ route('customer.reservations.cancel', $reservation->id) }}"
                                        method="POST">
                                        @csrf @method('PUT')
                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin membatalkan reservasi ini?')"
                                            class="inline-flex items-center px-2.5 py-1 border border-transparent text-xxs md:text-xs font-medium rounded shadow-sm text-white bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600">
                                            Batalkan
                                        </button>
                                    </form>
                                @elseif ($reservation->status === 'confirmed')
                                    <a href="{{ route('customer.reservations.show', $reservation->id) }}"
                                        class="inline-flex items-center px-2.5 py-1 border border-transparent text-xxs md:text-xs font-medium rounded shadow-sm text-white bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600">
                                        Detail
                                    </a>

                                    @if ($reservation->review)
                                        <button data-review-id="{{ $reservation->review->id }}"
                                            data-rating="{{ $reservation->review->rating }}"
                                            data-review="{{ htmlspecialchars($reservation->review->review, ENT_QUOTES) }}"
                                            class="edit-review-btn inline-flex items-center px-2.5 py-1 border border-gray-300 shadow-sm text-xxs md:text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                            Edit Ulasan
                                        </button>
                                    @else
                                        <a href="{{ route('customer.reviews.create', $reservation->id) }}"
                                            class="inline-flex items-center px-2.5 py-1 border border-transparent text-xxs md:text-xs font-medium rounded shadow-sm text-white bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600">
                                            Ulasan
                                        </a>
                                    @endif

                                    <form action="{{ route('customer.reservations.destroy', $reservation->id) }}"
                                        method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus reservasi ini?')"
                                            class="inline-flex items-center px-2.5 py-1 border border-gray-300 shadow-sm text-xxs md:text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50">
                                            Hapus
                                        </button>
                                    </form>
                                @elseif ($reservation->status === 'canceled')
                                    <form action="{{ route('customer.reservations.destroy', $reservation->id) }}"
                                        method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus reservasi ini?')"
                                            class="inline-flex items-center px-2.5 py-1 border border-transparent text-xxs md:text-xs font-medium rounded shadow-sm text-white bg-gradient-to-r from-gray-600 to-gray-500 hover:from-gray-700 hover:to-gray-600">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </li>
                    @endforeach
                </ul>

                <!-- Pagination -->
                @if ($reservations->hasPages())
                    <div class="bg-white px-3 py-3 border-t border-gray-200 sm:px-6">
                        <div class="flex justify-center">
                            {{ $reservations->links() }}
                        </div>
                    </div>
                @endif
            </div>
        @endif
    </div>

    {{-- Modal Edit Ulasan --}}
    <div id="review-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50 p-2">
        <div class="bg-white p-4 md:p-6 rounded-lg shadow-xl w-full max-w-md">
            <div class="flex justify-between items-center mb-3 md:mb-4">
                <h2 class="text-base md:text-lg font-bold text-gray-900">Edit Ulasan</h2>
                <button onclick="closeReviewModal()" class="text-gray-400 hover:text-gray-500">
                    <svg class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form id="review-form" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="review_id" id="review_id">

                <div class="mb-3 md:mb-4">
                    <label class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Rating</label>
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg id="star-{{ $i }}" class="h-6 w-6 md:h-8 md:w-8 cursor-pointer star-rating"
                                data-rating="{{ $i }}" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        @endfor
                        <input type="hidden" name="rating" id="modal_rating" value="5">
                    </div>
                </div>

                <div class="mb-3 md:mb-4">
                    <label for="modal_comment"
                        class="block text-xs md:text-sm font-medium text-gray-700 mb-1">Komentar</label>
                    <textarea name="comment" id="modal_comment" rows="3"
                        class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500 text-xs md:text-sm"></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeReviewModal()"
                        class="px-3 py-1.5 md:px-4 md:py-2 border border-gray-300 rounded-md shadow-sm text-xs md:text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="inline-flex justify-center py-1.5 px-3 md:py-2 md:px-4 border border-transparent shadow-sm text-xs md:text-sm font-medium rounded-md text-white bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize stars
            setRating(5);

            // Event delegation for edit buttons
            document.addEventListener('click', function(e) {
                // Handle edit review button click
                if (e.target.classList.contains('edit-review-btn') ||
                    e.target.closest('.edit-review-btn')) {
                    const btn = e.target.classList.contains('edit-review-btn') ?
                        e.target : e.target.closest('.edit-review-btn');

                    openReviewModal(
                        btn.dataset.reviewId,
                        parseInt(btn.dataset.rating),
                        btn.dataset.review
                    );
                }

                // Handle star rating clicks
                if (e.target.classList.contains('star-rating') ||
                    e.target.closest('.star-rating')) {
                    const star = e.target.classList.contains('star-rating') ?
                        e.target : e.target.closest('.star-rating');
                    const rating = parseInt(star.dataset.rating);
                    setRating(rating);
                }
            });
        });

        function openReviewModal(id, rating, review) {
            const modal = document.getElementById('review-modal');
            const form = document.getElementById('review-form');

            // Set form action
            form.action = `/customer/reviews/${id}`;

            // Set rating
            setRating(rating);

            // Set review text
            document.getElementById('modal_comment').value = decodeHtmlEntities(review);
            document.getElementById('review_id').value = id;

            // Show modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeReviewModal() {
            const modal = document.getElementById('review-modal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function setRating(rating) {
            // Update hidden input
            document.getElementById('modal_rating').value = rating;

            // Update all stars
            document.querySelectorAll('.star-rating').forEach(star => {
                const starRating = parseInt(star.dataset.rating);
                if (starRating <= rating) {
                    star.classList.add('text-yellow-400', 'fill-yellow-400');
                    star.classList.remove('text-gray-300');
                } else {
                    star.classList.add('text-gray-300');
                    star.classList.remove('text-yellow-400', 'fill-yellow-400');
                }
            });
        }

        function decodeHtmlEntities(text) {
            const textarea = document.createElement('textarea');
            textarea.innerHTML = text;
            return textarea.value;
        }
    </script>
@endpush
