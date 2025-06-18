<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Detail Pesanan</h2>
    </x-slot>

    <div class="py-4 px-6">
        <div class="bg-white rounded shadow p-4">
            <h3 class="text-lg font-bold mb-2">{{ $reservation->property->name }}</h3>

            @if ($reservation->property->images->isNotEmpty())
                <img src="{{ asset('storage/' . $reservation->property->images->first()->image_path) }}"
                    alt="Gambar Properti" class="w-full h-64 object-cover rounded mb-4">
            @endif

            <p><strong>Alamat:</strong> {{ $reservation->property->location }}</p>
            <p><strong>Harga per malam:</strong> Rp. {{ number_format($reservation->property->price_per_night) }}</p>
            <p><strong>Check-in:</strong> {{ $reservation->check_in_date }}</p>
            <p><strong>Check-out:</strong> {{ $reservation->check_out_date }}</p>
            <p><strong>Jumlah Tamu:</strong> {{ $reservation->jumlah_tamu }}</p>
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

            <p class="mt-2"><strong>Nama Pemesan:</strong> {{ $reservation->nama_lengkap }}</p>
            <p><strong>Email:</strong> {{ $reservation->email }}</p>
            <p><strong>No. HP:</strong> {{ $reservation->no_hp }}</p>

            {{-- @if ($reservation->status === 'pending')
                <div class="mt-4">
                    <a href="{{ route('customer.reservations.payment.form', $reservation->id) }}"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Bayar Sekarang
                    </a>
                </div>
            @endif --}}
        </div>

        <div class="mt-6">
            <a href="{{ route('customer.reservations.history') }}" class="text-blue-500 hover:underline">&larr; Kembali
                ke Riwayat</a>
        </div>
    </div>
</x-app-layout>
