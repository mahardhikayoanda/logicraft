@extends('layouts.customer')

@section('title', 'Riwayat Reservasi Saya')

@section('content')
    <div class="mb-6">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($reservations->isEmpty())
            <p class="text-gray-600">Anda belum memiliki reservasi.</p>
        @else
            <div class="space-y-6">
                @foreach ($reservations as $reservation)
                    <div class="border p-4 rounded shadow-sm bg-white">
                        <h3 class="text-lg font-bold mb-2">{{ $reservation->property->name }}</h3>
                        <p><strong>Alamat:</strong> {{ $reservation->property->location }}</p>
                        <p><strong>Check-in:</strong> {{ $reservation->check_in_date }}</p>
                        <p><strong>Check-out:</strong> {{ $reservation->check_out_date }}</p>
                        <p><strong>Total Harga:</strong> Rp. {{ number_format($reservation->total_price) }}</p>
                        <p><strong>Status:</strong>
                            <span
                                class="uppercase font-semibold text-sm
                            {{ match ($reservation->status) {
                                'pending' => 'text-yellow-600',
                                'confirmed' => 'text-blue-600',
                                'checked_in' => 'text-green-600',
                                'canceled' => 'text-red-600',
                                default => 'text-gray-600',
                            } }}">
                                {{ $reservation->status }}
                            </span>
                        </p>

                        {{-- Tombol aksi --}}
                        <div class="mt-4 flex flex-wrap gap-2">
                            @if ($reservation->status === 'pending')
                                <a href="{{ route('customer.reservations.show', $reservation->id) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Bayar</a>

                                <a href="{{ route('customer.reservations.edit', $reservation->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit</a>

                                <form action="{{ route('customer.reservations.cancel', $reservation->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
                                    @csrf @method('PUT')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Batalkan</button>
                                </form>
                            @elseif ($reservation->status === 'confirmed')
                                <a href="{{ route('customer.reservations.show', $reservation->id) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">Lihat
                                    Detail</a>

                                @if ($reservation->review)
                                    {{-- Tombol edit ulasan --}}
                                    <button
                                        onclick="openReviewModal({{ $reservation->review->id }}, {{ $reservation->review->rating }}, `{{ $reservation->review->comment }}`)"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">Edit
                                        Ulasan</button>
                                @else
                                    <a href="{{ route('customer.reviews.create', $reservation->id) }}"
                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-sm">Ulas</a>
                                @endif

                                <form action="{{ route('customer.reservations.destroy', $reservation->id) }}"
                                    method="POST" onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-1 rounded text-sm">Hapus</button>
                                </form>
                                
                            @elseif ($reservation->status === 'canceled')
                                <form action="{{ route('customer.reservations.destroy', $reservation->id) }}"
                                    method="POST" onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-1 rounded text-sm">Hapus
                                        Reservasi</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- Modal Edit Ulasan --}}
    <div id="review-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white p-6 rounded shadow-md w-full max-w-md">
            <h2 class="text-lg font-bold mb-4">Edit Ulasan</h2>

            <form id="review-form" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="review_id" id="review_id">

                <div class="mb-4">
                    <label for="modal_rating" class="block mb-1 font-semibold">Rating</label>
                    <select name="rating" id="modal_rating" class="w-full border rounded p-2">
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }} Bintang</option>
                        @endfor
                    </select>
                </div>

                <div class="mb-4">
                    <label for="modal_comment" class="block mb-1 font-semibold">Komentar</label>
                    <textarea name="comment" id="modal_comment" rows="4" class="w-full border rounded p-2"></textarea>
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeReviewModal()"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Batal</button>
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function openReviewModal(id, rating, review) {
            const modal = document.getElementById('review-modal');
            const form = document.getElementById('review-form');

            document.getElementById('modal_rating').value = rating;
            document.getElementById('modal_comment').value = review;

            form.action = `/customer/reviews/${id}`;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeReviewModal() {
            const modal = document.getElementById('review-modal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>
@endsection
