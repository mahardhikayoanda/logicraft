<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah User
        </h2>
    </x-slot>

    <div class="py-4 px-6">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label>Nama</label>
                <input type="text" name="name" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2" required>
            </div>

            <div class="mb-4">
                <label>Role</label>
                <select name="role" class="w-full border px-3 py-2" required>
                    <option value="admin">Admin</option>
                    <option value="owner">Owner</option>
                    <option value="resepsionis">Resepsionis</option>
                    <option value="customer">Customer</option>
                </select>
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="text-gray-700 ml-4">Batal</a>
        </form>
    </div>
</x-app-layout>
