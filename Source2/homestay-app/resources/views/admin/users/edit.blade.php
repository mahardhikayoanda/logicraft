@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit User</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
        class="bg-white p-6 rounded-lg shadow-md w-full max-w-xl">
        @csrf
        @method('PATCH')

        {{-- Nama --}}
        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Nama</label>
            <input type="text" id="name" name="name" class="w-full border border-gray-300 px-3 py-2 rounded"
                value="{{ old('name', $user->name) }}" required>
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" id="email" name="email" class="w-full border border-gray-300 px-3 py-2 rounded"
                value="{{ old('email', $user->email) }}" required>
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <label for="password" class="block font-semibold mb-1">Password (kosongkan jika tidak diganti)</label>
            <input type="password" id="password" name="password" class="w-full border border-gray-300 px-3 py-2 rounded">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Role --}}
        <div class="mb-6">
            <label for="role" class="block font-semibold mb-1">Role</label>
            <select name="role" id="role" class="w-full border border-gray-300 px-3 py-2 rounded" required>
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Owner</option>
                <option value="receptionist" {{ $user->role === 'receptionist' ? 'selected' : '' }}>Resepsionis</option>
                <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
            </select>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.users.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
@endsection
