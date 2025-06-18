<x-app-layout>

    @if (session('error'))
        <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
            {{ session('error') }}
        </div>
    @endif

    <x-slot name="header">
        <h2 class="text-xl font-semibold">Reservasi Properti: {{ $property->name }}</h2>
    </x-slot>

    <div class="py-4 px-6">
        <form method="POST" action="{{ route('customer.reservations.store', $property->id) }}">
            @csrf

            <div class="mb-4">
                <label for="nama_lengkap">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="w-full border p-2" required
                    value="{{ old('nama_lengkap') }}">
            </div>

            <div class="mb-4">
                <label for="email">Email</label>
                <input type="email" name="email" class="w-full border p-2" required value="{{ old('email') }}">
            </div>

            <div class="mb-4">
                <label for="no_hp">Nomor HP</label>
                <input type="text" name="no_hp" class="w-full border p-2" required value="{{ old('no_hp') }}">
            </div>

            <div class="mb-4">
                <label for="jumlah_tamu">Jumlah Tamu</label>
                <input type="number" name="jumlah_tamu" min="1" class="w-full border p-2" required
                    value="{{ old('jumlah_tamu', 1) }}">
            </div>

            <div class="mb-4">
                <label>Tanggal Check-in</label>
                <input type="date" name="check_in_date" required class="w-full border p-2"
                    value="{{ old('check_in_date') }}">
            </div>

            <div class="mb-4">
                <label>Tanggal Check-out</label>
                <input type="date" name="check_out_date" required class="w-full border p-2"
                    value="{{ old('check_out_date') }}">
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Konfirmasi Pemesanan</button>
        </form>

    </div>
</x-app-layout>
