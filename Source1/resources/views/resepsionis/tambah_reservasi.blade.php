@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h2>Tambah Reservasi</h2>

    <form action="{{ route('reservasi.simpan') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Tamu</label>
            <input type="text" name="nama_tamu" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Tanggal Check-in</label>
            <input type="date" name="tanggal_checkin" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Tanggal Check-out</label>
            <input type="date" name="tanggal_checkout" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Tipe Kamar</label>
            <select name="tipe_kamar" class="form-control" required>
                <option value="Standar">Standar</option>
                <option value="Deluxe">Deluxe</option>
                <option value="Suite">Suite</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Simpan Reservasi</button>
    </form>
</div>
@endsection
