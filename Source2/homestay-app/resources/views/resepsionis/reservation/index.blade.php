@extends('layouts.resepsionis')

@section('title', 'Daftar Reservasi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Daftar Reservasi</h1>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Nama Tamu</th>
                    <th class="px-4 py-2 text-left">Properti</th>
                    <th class="px-4 py-2 text-left">Check-in</th>
                    <th class="px-4 py-2 text-left">Check-out</th>
                    <th class="px-4 py-2 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($reservations as $reservation)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $reservation->customer->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $reservation->property->name ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $reservation->check_in_date }}</td>
                        <td class="px-4 py-2">{{ $reservation->check_out_date }}</td>
                        <td class="px-4 py-2">{{ ucfirst($reservation->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada reservasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
