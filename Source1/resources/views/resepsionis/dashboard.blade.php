@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h2>Dashboard Resepsionis</h2>

    <a href="{{ route('reservasi.tambah') }}" class="btn btn-primary mt-3">Tambah Reservasi</a>
    <a href="{{ route('reservasi.index') }}" class="btn btn-outline-primary mt-3">Lihat Daftar Reservasi</a>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif
@endsection
