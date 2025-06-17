<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-4 px-6">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="name" class="w-full border px-3 py-2" value="{{ $user->name }}" required>
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2" value="{{ $user->email }}"
                    required>
            </div>

            <div class="mb-4">
                <label>Password (kosongkan jika tidak diganti)</label>
                <input type="password" name="password" class="w-full border px-3 py-2">
            </div>

            <div class="mb-4">
                <label>Role</label>
                <select name="role" class="w-full border px-3 py-2" required>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Owner</option>
                    <option value="resepsionis" {{ $user->role === 'resepsionis' ? 'selected' : '' }}>Resepsionis
                    </option>
                    <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('admin.users.index') }}" class="text-gray-700 ml-4">Batal</a>
        </form>
    </div>
</x-app-layout>
