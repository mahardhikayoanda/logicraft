@extends('layouts.layouts')

@section('content')
<div class="container mt-4">
    <h2>Beri Ulasan untuk</h2>

    {{-- Tampilkan pesan sukses jika ada --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tampilkan pesan error validasi jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('reviews.store') }}">
        @csrf
        <input type="hidden" name="reservation_id" value="">

        <div class="form-group mb-3">
            <label for="rating">Rating</label>
            <select name="rating" id="rating" class="form-control" required>
                <option value="">-- Pilih Rating --</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                        {{ $i }} ★
                    </option>
                @endfor
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="ulasan">Ulasan</label>
            <textarea name="ulasan" id="ulasan" class="form-control" rows="4" required>{{ old('ulasan') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
    </form>
</div>
@endsection
