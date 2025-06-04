@extends('layouts.layouts')

@section('content')
    <h2>Reservasi yang Sudah Dihapus</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Nama Tamu</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Tipe Kamar</th>
                <th>Dihapus Pada</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->nama_tamu }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->no_hp }}</td>
                    <td>{{ $item->tanggal_checkin }}</td>
                    <td>{{ $item->tanggal_checkout }}</td>
                    <td>{{ $item->tipe_kamar }}</td>
                    <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('reservasi.index') }}" class="btn btn-secondary">Kembali ke Daftar</a>
@endsection
