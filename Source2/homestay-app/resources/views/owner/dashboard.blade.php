@extends('layouts.owner')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Selamat datang, {{ Auth::user()->name }}</h1>
    <p>Ini adalah dashboard pemilik properti.</p>
@endsection
