@extends('layouts.admin')

@section('content')
    <h2 class="text-2xl font-bold text-gray-800 leading-tight mb-4">Manajemen User</h2>

    <a href="{{ route('admin.users.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah User</a>

    @if (session('success'))
        <div class="text-green-600 mt-4">{{ session('success') }}</div>
    @endif

    <table class="w-full mt-4 table-auto border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Email</th>
                <th class="border px-4 py-2">Role</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($user->role) }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-yellow-600">Edit</a>
                        |
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border px-4 py-2 text-center">Tidak ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
