@extends('layouts.resepsionis')

@section('title', 'Daftar Promosi')
@section('header', 'Daftar Promosi')

@section('content')
    <div class="flex-1 p-4 md:p-6">
        <!-- Success Notification -->
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 text-xl mr-3"></i>
                    <div>
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                        <p class="text-green-600 text-sm mt-1">Perubahan telah berhasil disimpan</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Header and Add Button -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Promosi</h1>
                <p class="text-gray-500 text-sm mt-1">Kelola semua promosi yang tersedia</p>
            </div>
            <a href="{{ route('resepsionis.promotions.create') }}"
                class="flex items-center bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white px-4 py-2.5 rounded-lg shadow-sm transition-all duration-200 whitespace-nowrap">
                <i class="fas fa-plus mr-2"></i>Tambah Promosi
            </a>
        </div>

        <!-- Promotion Cards (Mobile) -->
        <div class="sm:hidden space-y-4 mb-6">
            @forelse ($promotions as $promotion)
                <div
                    class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-shadow duration-200">
                    @if ($promotion->image_path)
                        <div class="h-48 w-full overflow-hidden">
                            <img src="{{ asset('storage/' . $promotion->image_path) }}" alt="Promosi"
                                class="w-full h-full object-cover">
                        </div>
                    @endif
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-lg text-gray-800">{{ $promotion->title }}</h3>
                            <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
                                {{ \Carbon\Carbon::parse($promotion->start_date)->format('d M') }} -
                                {{ \Carbon\Carbon::parse($promotion->end_date)->format('d M Y') }}
                            </span>
                        </div>

                        <p class="text-gray-600 text-sm mt-2 line-clamp-2">
                            {{ $promotion->description ?: 'Tidak ada deskripsi' }}
                        </p>

                        <div class="flex justify-end space-x-3 mt-4 pt-3 border-t border-gray-100">
                            <a href="{{ route('resepsionis.promotions.edit', $promotion->id) }}"
                                class="text-blue-600 hover:text-blue-800 transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('resepsionis.promotions.destroy', $promotion->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus promosi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition-colors">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow p-6 text-center">
                    <i class="fas fa-tag text-gray-400 text-4xl mb-3"></i>
                    <h3 class="text-gray-600 font-medium">Belum ada promosi</h3>
                    <p class="text-gray-500 text-sm mt-1">Mulai dengan menambahkan promosi baru</p>
                    <a href="{{ route('resepsionis.promotions.create') }}"
                        class="inline-block mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm">
                        Tambah Promosi
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Promotion Table (Desktop) -->
        <div class="hidden sm:block bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Promosi
                            </th>
                            <th
                                class="hidden lg:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Periode
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($promotions as $promotion)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if ($promotion->image_path)
                                            <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden mr-4">
                                                <img src="{{ asset('storage/' . $promotion->image_path) }}" alt="Promosi"
                                                    class="h-full w-full object-cover">
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-medium text-gray-900">{{ $promotion->title }}</div>
                                            <div class="text-gray-500 text-sm lg:hidden mt-1 line-clamp-1">
                                                {{ $promotion->description ?: '-' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden lg:table-cell px-6 py-4 whitespace-normal text-sm text-gray-500 max-w-xs">
                                    <div class="line-clamp-2">
                                        {{ $promotion->description ?: '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($promotion->start_date)->format('d M Y') }}
                                        </span>
                                        <span class="text-xs text-gray-400 text-center">sampai</span>
                                        <span class="text-sm font-medium text-gray-900">
                                            {{ \Carbon\Carbon::parse($promotion->end_date)->format('d M Y') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        <a href="{{ route('resepsionis.promotions.edit', $promotion->id) }}"
                                            class="text-blue-600 hover:text-blue-900 transition-colors inline-flex items-center"
                                            title="Edit">
                                            <i class="fas fa-edit mr-1"></i>
                                            <span class="sr-only">Edit</span>
                                        </a>
                                        <form action="{{ route('resepsionis.promotions.destroy', $promotion->id) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus promosi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 transition-colors inline-flex items-center"
                                                title="Hapus">
                                                <i class="fas fa-trash-alt mr-1"></i>
                                                <span class="sr-only">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center text-gray-400">
                                        <i class="fas fa-tag text-4xl mb-3"></i>
                                        <h3 class="text-lg font-medium text-gray-500">Belum ada promosi</h3>
                                        <p class="text-sm mt-1">Mulai dengan menambahkan promosi baru</p>
                                        <a href="{{ route('resepsionis.promotions.create') }}"
                                            class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm">
                                            Tambah Promosi
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($promotions->hasPages())
                <div class="bg-white px-6 py-4 border-t border-gray-200">
                    {{ $promotions->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .line-clamp-1 {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
