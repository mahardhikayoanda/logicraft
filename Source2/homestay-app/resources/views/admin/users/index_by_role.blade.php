@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold text-gray-800 mb-4">
        User dengan Role: {{ ucfirst($role) }}
    </h1>

    <a href="{{ route('admin.users.index') }}" class="text-sm text-blue-500 underline mb-4 inline-block">
        ← Kembali ke Semua User
    </a>

    @if (session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="min-w-full table-auto border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border text-left">Nama</th>
                    <th class="px-4 py-2 border text-left">Email</th>
                    <th class="px-4 py-2 border text-left">Role</th>
                    <th class="px-4 py-2 border text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border">{{ ucfirst($user->role) }}</td>
                        <td class="px-4 py-2 border">
                            @if ($role === 'owner')
                                <a href="{{ route('admin.users.detailOwner', $user->id) }}"
                                    class="text-green-600 hover:underline">Detail</a> |
                            @endif
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="text-yellow-600 hover:underline">Edit</a>
                            |
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">Tidak ada user dengan role ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
