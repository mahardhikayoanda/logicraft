@extends('layouts.customer')

@section('title', 'Edit Reservasi')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('customer.reservations.update', $reservation->id) }}">
            @csrf
            @method('PUT')

            {{-- Nama Lengkap --}}
            <div class="mb-4">
                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap Sesuai KTP</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="w-full border p-2 rounded"
                    value="{{ old('nama_lengkap', $reservation->nama_lengkap) }}" required>
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="w-full border p-2 rounded"
                    value="{{ old('email', $reservation->email) }}" required>
            </div>

            {{-- Nomor HP --}}
            <div class="mb-4">
                <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                <input type="text" name="no_hp" id="no_hp" class="w-full border p-2 rounded"
                    value="{{ old('no_hp', $reservation->no_hp) }}" required>
            </div>

            {{-- Jumlah Tamu --}}
            <div class="mb-4">
                <label for="jumlah_tamu" class="block text-sm font-medium text-gray-700">Jumlah Tamu</label>
                <input type="number" name="jumlah_tamu" id="jumlah_tamu" min="1" class="w-full border p-2 rounded"
                    value="{{ old('jumlah_tamu', $reservation->jumlah_tamu) }}" required>
            </div>

            {{-- Tanggal Check-in --}}
            <div class="mb-4">
                <label for="check_in_date" class="block text-sm font-medium text-gray-700">Tanggal Check-in</label>
                <input type="date" name="check_in_date" id="check_in_date" class="w-full border p-2 rounded"
                    value="{{ old('check_in_date', $reservation->check_in_date) }}" required>
            </div>

            {{-- Tanggal Check-out --}}
            <div class="mb-4">
                <label for="check_out_date" class="block text-sm font-medium text-gray-700">Tanggal Check-out</label>
                <input type="date" name="check_out_date" id="check_out_date" class="w-full border p-2 rounded"
                    value="{{ old('check_out_date', $reservation->check_out_date) }}" required>
            </div>

            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Update Reservasi
            </button>
        </form>
    </div>
@endsection
