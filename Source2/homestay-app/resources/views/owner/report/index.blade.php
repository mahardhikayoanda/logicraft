@extends('layouts.owner')

@section('content')
    <h2 class="text-xl font-semibold mb-4">Laporan Pembukuan</h2>

    <div class="bg-white shadow p-4 rounded mb-6">
        <p><strong>Total Properti:</strong> {{ $totalProperties }}</p>
        <p><strong>Total Reservasi:</strong> {{ $totalReservations }}</p>
        <p><strong>Total Pendapatan:</strong> Rp{{ number_format($totalIncome, 0, ',', '.') }}</p>
    </div>

    <h3 class="text-lg font-semibold mb-2">Ringkasan Per Properti</h3>

    <table class="w-full table-auto border">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2 text-left">Nama Properti</th>
                <th class="border px-4 py-2 text-left">Jumlah Reservasi</th>
                <th class="border px-4 py-2 text-left">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($properties as $property)
                <tr>
                    <td class="border px-4 py-2">{{ $property->name }}</td>
                    <td class="border px-4 py-2">{{ $property->reservations->count() }}</td>
                    <td class="border px-4 py-2">
                        Rp{{ number_format($property->reservations->sum('total_price'), 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-4">Belum ada properti.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
