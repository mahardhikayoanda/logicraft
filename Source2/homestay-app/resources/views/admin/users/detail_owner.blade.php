@extends('layouts.admin')

@section('header', 'Detail Owner: ' . $user->name)

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Detail Owner</h2>
                <p class="text-sm text-gray-500 mt-1">ID: {{ $user->id }}</p>
            </div>
            <a href="{{ route('admin.users.byRole', 'owner') }}"
                class="text-sm text-blue-500 hover:text-blue-700 inline-flex items-center">
                <i class="fas fa-arrow-left mr-1"></i>
                Kembali ke Daftar Owner
            </a>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Owner Information -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Informasi Owner</h3>
                <div class="space-y-3">
                    <div class="flex items-start">
                        <i class="fas fa-user text-gray-400 mt-1 mr-3 w-4"></i>
                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="font-medium">{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-envelope text-gray-400 mt-1 mr-3 w-4"></i>
                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="font-medium">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-home text-gray-400 mt-1 mr-3 w-4"></i>
                        <div>
                            <p class="text-sm text-gray-500">Total Properti</p>
                            <p class="font-medium">{{ $totalProperties }}</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-money-bill-wave text-gray-400 mt-1 mr-3 w-4"></i>
                        <div>
                            <p class="text-sm text-gray-500">Total Pendapatan</p>
                            <p class="font-medium">Rp{{ number_format($totalIncome, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Properties List -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-lg font-medium text-gray-800 mb-4 border-b pb-2">Daftar Properti</h3>
                @if ($properties->count() > 0)
                    <div class="space-y-4">
                        @foreach ($properties as $property)
                            <div class="border-b border-gray-200 pb-3 last:border-b-0 last:pb-0">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-medium">{{ $property->name }}</p>
                                        <p class="text-sm text-gray-500 mt-1">
                                            Pendapatan:
                                            Rp{{ number_format($property->reservations()->sum('total_price'), 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Owner ini belum memiliki properti</p>
                @endif
            </div>
        </div>
    </div>
@endsection
