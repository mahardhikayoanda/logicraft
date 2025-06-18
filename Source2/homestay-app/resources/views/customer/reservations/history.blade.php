<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Riwayat Reservasi Saya</h2>
    </x-slot>

    <div class="py-4 px-6">
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($reservations->isEmpty())
            <p>Anda belum memiliki reservasi.</p>
        @else
            <div class="space-y-6">
                @foreach ($reservations as $reservation)
                    <div class="border p-4 rounded shadow-sm">
                        <h3 class="text-lg font-bold mb-2">{{ $reservation->property->name }}</h3>
                        <p><strong>Alamat:</strong> {{ $reservation->property->location }}</p>
                        <p><strong>Check-in:</strong> {{ $reservation->check_in_date }}</p>
                        <p><strong>Check-out:</strong> {{ $reservation->check_out_date }}</p>
                        <p><strong>Total Harga:</strong> Rp. {{ number_format($reservation->total_price) }}</p>
                        <p><strong>Status:</strong>
                            <span
                                class="uppercase font-semibold text-sm {{ $reservation->status === 'pending'
                                    ? 'text-yellow-600'
                                    : ($reservation->status === 'confirmed'
                                        ? 'text-blue-600'
                                        : ($reservation->status === 'checked_in'
                                            ? 'text-green-600'
                                            : ($reservation->status === 'canceled'
                                                ? 'text-red-600'
                                                : 'text-gray-600'))) }}">
                                {{ $reservation->status }}
                            </span>
                        </p>

                        {{-- Tindakan berdasarkan status --}}
                        @if ($reservation->status === 'pending')
                            <div class="mt-4 flex gap-2">
                                <a href="{{ route('customer.reservations.show', $reservation->id) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    Lihat Detail
                                </a>

                                <a href="{{ route('customer.reservations.edit', $reservation->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                    Edit
                                </a>

                                <a href="{{ route('customer.reservations.edit', $reservation->id) }}"
                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-sm">
                                    Bayar
                                </a>

                                <form action="{{ route('customer.reservations.cancel', $reservation->id) }}"
                                    method="POST" onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                                        Batalkan
                                    </button>
                                </form>
                            </div>
                        @elseif ($reservation->status === 'canceled')
                            <div class="mt-4">
                                <form action="{{ route('customer.reservations.destroy', $reservation->id) }}"
                                    method="POST" onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-1 rounded text-sm">
                                        Hapus Reservasi
                                    </button>
                                </form>
                            </div>
                        @elseif ($reservation->status === 'confirmed')
                            <div class="mt-4 flex gap-3">
                                <a href="{{ route('customer.reservations.show', $reservation->id) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm">
                                    Lihat Detail
                                </a>
                                <a href="{{ route('customer.reservations.show', $reservation->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                    Ulas
                                </a>
                                <form action="{{ route('customer.reservations.destroy', $reservation->id) }}"
                                    method="POST" onsubmit="return confirm('Yakin ingin menghapus reservasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-gray-700 hover:bg-gray-800 text-white px-3 py-1 rounded text-sm">
                                        Hapus Reservasi
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
