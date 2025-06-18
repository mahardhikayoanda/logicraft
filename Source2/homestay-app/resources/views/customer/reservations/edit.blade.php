<x-app-layout>
    <h2 class="text-xl font-semibold mb-4">Edit Reservasi</h2>

    <form method="POST" action="{{ route('customer.reservations.update', $reservation->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label>Tanggal Check-in</label>
            <input type="date" name="check_in_date" value="{{ old('check_in_date', $reservation->check_in_date) }}" class="w-full border p-2" required>
        </div>

        <div class="mb-4">
            <label>Tanggal Check-out</label>
            <input type="date" name="check_out_date" value="{{ old('check_out_date', $reservation->check_out_date) }}" class="w-full border p-2" required>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Reservasi</button>
    </form>
</x-app-layout>
