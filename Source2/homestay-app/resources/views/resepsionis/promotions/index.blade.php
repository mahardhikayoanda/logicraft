@extends('layouts.resepsionis')

@section('title', 'Daftar Promosi')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Daftar Promosi</h1>
        <a href="{{ route('resepsionis.promotions.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow-sm">
            + Tambah Promosi
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full table-auto border-collapse">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-4 py-2 text-left">Judul</th>
                    <th class="px-4 py-2 text-left">Deskripsi</th>
                    <th class="px-4 py-2 text-left">Periode</th>
                    <th class="px-4 py-2 text-left">Gambar</th>
                    <th class="px-4 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($promotions as $promotion)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $promotion->title }}</td>
                        <td class="px-4 py-2">{{ $promotion->description ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $promotion->start_date }} s/d {{ $promotion->end_date }}</td>
                        <td class="px-4 py-2">
                            @if ($promotion->image_path)
                                <img src="{{ asset('storage/' . $promotion->image_path) }}" alt="Promosi" class="h-16 w-auto rounded">
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('resepsionis.promotions.edit', $promotion->id) }}"
                               class="text-yellow-600 hover:underline">Edit</a>
                            <form action="{{ route('resepsionis.promotions.destroy', $promotion->id) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus promosi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-4 text-center text-gray-500">Belum ada promosi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
