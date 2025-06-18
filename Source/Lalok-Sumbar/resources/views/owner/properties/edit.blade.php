@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Property</h1>
    <form action="{{ route('owner.properties.update', $property->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <!-- Tambahkan form fields sesuai kebutuhan -->
        <div class="form-group">
            <label for="name">Property Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $property->name }}" required>
        </div>
        <!-- Tambahkan field lainnya -->
        <button type="submit" class="btn btn-primary">Update Property</button>
    </form>
</div>
@endsection