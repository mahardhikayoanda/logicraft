@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Tambah User</h1>

    <form action="{{ route('admin.users.store') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-xl">
        @csrf

        {{-- Nama --}}
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama</label>
            <input type="text" id="name" name="name" class="w-full border border-gray-300 px-3 py-2 rounded"
                required value="{{ old('name') }}">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" class="w-full border border-gray-300 px-3 py-2 rounded"
                required value="{{ old('email') }}">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label for="password" class="block font-semibold mb-1">Password</label>
            <input type="password" id="password" name="password" class="w-full border border-gray-300 px-3 py-2 rounded"
                required>
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Role --}}
        <div class="mb-6">
            <label for="role" class="block font-semibold mb-1">Role</label>
            <select id="role" name="role" class="w-full border border-gray-300 px-3 py-2 rounded" required>
                <option value="" disabled selected>Pilih Role</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="owner" {{ old('role') === 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="receptionist" {{ old('role') === 'receptionist' ? 'selected' : '' }}>Resepsionis</option>
                <option value="customer" {{ old('role') === 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
@endsection
