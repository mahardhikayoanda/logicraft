@extends('layouts.app')

@section('content')
<div class="bg-white min-h-screen px-6 py-10">
    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-2xl font-bold">Riwayat Transaksi</h2>
            <p class="text-sm text-gray-600">Berikut adalah daftar transaksi yang telah dilakukan pada properti Anda.</p>
        </div>
    </div>

    {{-- Filter Section (Step 6 dari scenario) --}}
    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <form method="GET" action="{{ route('transactions.index') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-48">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="dibatalkan" {{ request('status') === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            
            <div class="flex-1 min-w-48">
                <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="flex-1 min-w-48">
                <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Filter
                </button>
                <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- Summary Info --}}
    @if(request()->hasAny(['status', 'date_from', 'date_to']))
    <div class="mb-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-sm text-blue-800">
            Menampilkan {{ $transactions->total() }} transaksi
            @if(request('status')) dengan status "{{ ucfirst(request('status')) }}" @endif
            @if(request('date_from') || request('date_to'))
                dari periode {{ request('date_from') ?: 'awal' }} sampai {{ request('date_to') ?: 'sekarang' }}
            @endif
        </p>
    </div>
    @endif

    {{-- Table Transaksi --}}
    <div class="overflow-x-auto bg-gray-100 rounded-lg shadow">
        <table class="min-w-full text-sm text-gray-700">
            <thead class="bg-black text-white">
                <tr>
                    <th class="text-left px-6 py-3">ID</th>
                    <th class="text-left px-6 py-3">Tanggal</th>
                    <th class="text-left px-6 py-3">Properti</th>
                    <th class="text-left px-6 py-3">Customer</th>
                    <th class="text-left px-6 py-3">Jumlah</th>
                    <th class="text-left px-6 py-3">Status</th>
                    <th class="text-left px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $t)
                    <tr class="border-b hover:bg-gray-200 transition duration-150">
                        <td class="px-6 py-4 font-medium">#{{ $t->id }}</td>
                        <td class="px-6 py-4">{{ $t->created_at->format('d/m/Y H:i') }}</td>
                        <td class="px-6 py-4 font-medium">{{ $t->property->name }}</td>
                        <td class="px-6 py-4">{{ $t->customer->name }}</td>
                        <td class="px-6 py-4">Rp {{ number_format($t->amount, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if ($t->status === 'selesai')
                                <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">Selesai</span>
                            @elseif ($t->status === 'pending')
                                <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">Menunggu</span>
                            @else
                                <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 rounded-full">Dibatalkan</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{-- Step 7: Link untuk melihat detail (sesuai scenario) --}}
                            <a href="{{ route('transactions.show', $t->id) }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium text-sm hover:underline">
                                Lihat Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-8">
                            <div class="text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-lg font-medium">Tidak ada transaksi ditemukan</p>
                                <p class="text-sm">{{ request()->hasAny(['status', 'date_from', 'date_to']) ? 'Coba ubah filter pencarian Anda' : 'Belum ada transaksi yang tercatat' }}</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if(method_exists($transactions, 'hasPages') && $transactions->hasPages())
    <div class="mt-6">
        {{ $transactions->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection