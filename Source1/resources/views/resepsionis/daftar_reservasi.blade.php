@extends('layouts.layouts')

@section('content')
<div class="container">
    <h1>Daftar Reservasi</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Ubah</th>
                <th>Hapus</th>
                <th>Ulasan</th>
                <th>Nama Tamu</th>
                <th>Email</th>
                <th>No HP</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Tipe Kamar</th>
                <th>Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservasi as $data)
            <tr>
                <td>
                    <a href="{{ route('reservasi.edit', $data->id) }}" class="btn btn-warning">Edit</a>
                </td>
                <td>
                    <form action="{{ route('reservasi.destroy', $data->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </td>
                <td>{{ $data->nama_tamu }}</td>
                <td>{{ $data->email }}</td>
                <td>{{ $data->no_hp }}</td>
                <td>{{ $data->tanggal_checkin }}</td> <!-- ✅ Check-in -->
                <td>{{ $data->tanggal_checkout }}</td> <!-- ✅ Check-out -->
                <td>{{ $data->tipe_kamar }}</td>
                <td>{{ $data->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
</div>
@endsection
