@extends('layouts.layouts')

@section('content')
<h2>Edit Reservasi</h2>

<form method="POST" action="{{ route('reservasi.update', $reservasi->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label>Nama Tamu</label>
        <input type="text" name="nama_tamu" class="form-control" value="{{ $reservasi->nama_tamu }}">
    </div>
    <div class="mb-2">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="{{ $reservasi->email }}">
    </div>
    <div class="mb-2">
        <label>No HP</label>
        <input type="text" name="no_hp" class="form-control" value="{{ $reservasi->no_hp }}">
    </div>
    <div class="mb-2">
        <label>Check-in</label>
        <input type="date" name="tanggal_checkin" class="form-control" value="{{ $reservasi->tanggal_checkin }}">
    </div>
    <div class="mb-2">
        <label>Check-out</label>
        <input type="date" name="tanggal_checkout" class="form-control" value="{{ $reservasi->tanggal_checkout }}">
    </div>
    <div class="mb-2">
        <label>Tipe Kamar</label>
        <select name="tipe_kamar" class="form-control">
            <option {{ $reservasi->tipe_kamar == 'Deluxe' ? 'selected' : '' }}>Deluxe</option>
            <option {{ $reservasi->tipe_kamar == 'Standar' ? 'selected' : '' }}>Standar</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success mt-2">Simpan Perubahan</button>
</form>
@endsection
