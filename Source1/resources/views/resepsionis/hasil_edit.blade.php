@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h2>Data Reservasi Berhasil Diubah</h2>

    <h4>🔁 Data Sebelum Diubah:</h4>
    <ul>
        @foreach ($sebelum as $key => $value)
            <li><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</li>
        @endforeach
    </ul>

    <hr>

    <h4>✅ Data Sesudah Diubah:</h4>
    <ul>
        <li><strong>Nama Tamu:</strong> {{ $sesudah->nama_tamu }}</li>
        <li><strong>Email:</strong> {{ $sesudah->email }}</li>
        <li><strong>No HP:</strong> {{ $sesudah->no_hp }}</li>
        <li><strong>Check-in:</strong> {{ $sesudah->tanggal_checkin }}</li>
        <li><strong>Check-out:</strong> {{ $sesudah->tanggal_checkout }}</li>
        <li><strong>Tipe Kamar:</strong> {{ $sesudah->tipe_kamar }}</li>
    </ul>

    <a href="{{ route('reservasi.index') }}" class="btn btn-primary mt-3">Kembali ke Daftar Reservasi</a>
</div>
@endsection
