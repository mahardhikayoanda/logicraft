@extends('layouts.owner')

@section('header', 'Daftar Properti')

@section('content')
    <div class="bg-white rounded-xl shadow-sm p-6">
        <!-- Header and Controls -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Kelola Properti Anda</h2>
                <p class="text-gray-600">Daftar semua properti yang Anda miliki</p>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">

                <!-- Add Property Button -->
                <a href="{{ route('owner.properties.create') }}"
                    class="bg-sky-600 hover:bg-sky-700 text-white px-5 py-2.5 rounded-lg flex items-center justify-center transition-colors whitespace-nowrap">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Properti
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <i class="fas fa-home text-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Properti</p>
                        <p class="text-xl font-bold text-gray-800">{{ $properties->total() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Property Grid -->
        @if ($properties->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($properties as $property)
                    <div
                        class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-shadow duration-300 flex flex-col h-full">
                        <!-- Property Image -->
                        <div class="relative">
                            @if ($property->images->count())
                                <img src="{{ asset('storage/' . $property->images->first()->image_path) }}"
                                    alt="{{ $property->name }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                                    <i class="fas fa-home text-4xl"></i>
                                </div>
                            @endif
                        </div>

                        <!-- Property Details -->
                        <div class="p-5 flex-grow flex flex-col">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-gray-800 truncate">{{ $property->name }}</h3>
                                <span class="bg-sky-100 text-sky-800 text-xs px-2 py-1 rounded-full whitespace-nowrap">
                                    {{ $property->type }}
                                </span>
                            </div>

                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <i class="fas fa-map-marker-alt mr-1.5"></i>
                                <span class="truncate">{{ $property->location }}</span>
                            </div>

                            <p class="text-gray-600 text-sm mb-4 line-clamp-2 flex-grow">
                                {{ $property->description }}
                            </p>

                            <div class="mt-auto">
                                <!-- Price -->
                                <p class="text-sky-600 font-semibold mb-4">
                                    Rp {{ number_format($property->price_per_night) }}
                                    <span class="text-gray-500 text-sm font-normal">/malam</span>
                                </p>

                                <!-- Action Buttons -->
                                <div class="flex items-center justify-between border-t pt-4">
                                    <a href="{{ route('owner.properties.show', $property) }}"
                                        class="text-sm text-sky-600 hover:text-sky-700 hover:underline flex items-center">
                                        Lihat Detail
                                        <i class="fas fa-chevron-right ml-1 text-xs"></i>
                                    </a>

                                    <div class="flex space-x-2">
                                        <!-- Edit Button -->
                                        <a href="{{ route('owner.properties.edit', $property) }}"
                                            class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-gray-700 rounded-full hover:bg-gray-100 transition-colors"
                                            title="Edit">
                                            <i class="fas fa-pencil-alt text-sm"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <form action="{{ route('owner.properties.destroy', $property) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-red-500 rounded-full hover:bg-gray-100 transition-colors"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus properti ini?')"
                                                title="Hapus">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-4">
                    <i class="fas fa-home text-3xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-800 mb-2">Belum ada properti</h3>
                <p class="text-gray-500 mb-6">Mulai dengan menambahkan properti pertama Anda</p>
                <a href="{{ route('owner.properties.create') }}"
                    class="inline-flex items-center bg-sky-600 hover:bg-sky-700 text-white px-5 py-2.5 rounded-lg transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Properti
                </a>
            </div>
        @endif

        <!-- Pagination -->
        @if ($properties->hasPages())
            <div class="mt-8">
                {{ $properties->links() }}
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
@endpush
