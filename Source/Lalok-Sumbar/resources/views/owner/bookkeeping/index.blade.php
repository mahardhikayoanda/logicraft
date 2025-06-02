@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    {{-- Navigation Bar --}}
    <nav class="bg-white shadow-sm border-b px-8 py-4">
        <div class="flex justify-between items-center">
            <a href="{{ route('owner.dashboard') }}">
                <h1 class="text-xl font-bold text-gray-800">Dashboard Owner</h1>
            </a>
            <div class="flex space-x-6">
                <a href="{{ route('owner.bookkeeping') }}" class="text-blue-600 hover:text-blue-800 font-medium border-b-2 border-blue-600">Pembukuan</a>
                <a href="{{ route('owner.properties') }}" class="text-gray-600 hover:text-gray-800 font-medium">Properti</a>
                <a href="{{ route('owner.transactions') }}" class="text-gray-600 hover:text-gray-800 font-medium">Transaksi</a>
            </div>
        </div>
    </nav>

    <div class="px-8 py-6">
        {{-- Header Pembukuan --}}
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Pembukuan Sederhana</h2>
            <p class="text-gray-600">Kelola dan pantau data keuangan properti Anda</p>
        </div>

        {{-- Filter Periode Waktu --}}
        <div class="bg-white rounded-lg shadow-sm border p-6 mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Filter Periode</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Periode</label>
                    <select class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="harian">Harian</option>
                        <option value="bulanan" selected>Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                    <input type="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="2024-01-01">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                    <input type="date" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="2024-12-31">
                </div>
                <div class="flex items-end">
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        Filter Data
                    </button>
                </div>
            </div>
        </div>

        {{-- Ringkasan Keuangan --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pemasukan</p>
                        <p class="text-2xl font-bold text-green-600">Rp 15.500.000</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Pengeluaran</p>
                        <p class="text-2xl font-bold text-red-600">Rp 8.750.000</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">Saldo Bersih</p>
                        <p class="text-2xl font-bold text-blue-600">Rp 6.750.000</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Data Pembukuan --}}
        <div class="bg-white rounded-lg shadow-sm border overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Data Pembukuan Periode: Januari - Desember 2024</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemasukan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengeluaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr class="hover:bg-gray-50 cursor-pointer" onclick="showDetailModal('1')">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15/01/2024</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Sewa Properti
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Sewa Rumah A - Januari</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">Rp 2.500.000</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900" onclick="showDetailModal('1')">Lihat Detail</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 cursor-pointer" onclick="showDetailModal('2')">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">20/01/2024</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Maintenance
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Perbaikan AC Rumah A</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">Rp 750.000</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900" onclick="showDetailModal('2')">Lihat Detail</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 cursor-pointer" onclick="showDetailModal('3')">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15/02/2024</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Sewa Properti
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Sewa Rumah B - Februari</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">Rp 3.000.000</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900" onclick="showDetailModal('3')">Lihat Detail</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 cursor-pointer" onclick="showDetailModal('4')">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">28/02/2024</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    Operasional
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Biaya Listrik & Air</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-red-600">Rp 450.000</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900" onclick="showDetailModal('4')">Lihat Detail</button>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 cursor-pointer" onclick="showDetailModal('5')">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">15/03/2024</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Sewa Properti
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">Sewa Apartemen C - Maret</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">Rp 4.000.000</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">-</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <button class="text-blue-600 hover:text-blue-900" onclick="showDetailModal('5')">Lihat Detail</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between">
                    <p class="text-sm text-gray-600">Menampilkan 5 dari 25 data</p>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-100">Sebelumnya</button>
                        <button class="px-3 py-1 bg-blue-600 text-white rounded text-sm">1</button>
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-100">2</button>
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-100">3</button>
                        <button class="px-3 py-1 border border-gray-300 rounded text-sm hover:bg-gray-100">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-between items-center mb-8">
            <a href="{{ route('owner.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                ← Kembali ke Dashboard
            </a>
            <div class="flex space-x-4">
                <button class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Export Excel
                </button>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    Tambah Data
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal Detail Transaksi --}}
<div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Detail Transaksi</h3>
                <button onclick="closeDetailModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent" class="space-y-3">
                <!-- Content will be populated by JavaScript -->
            </div>
            <div class="flex justify-end mt-6 space-x-3">
                <button onclick="closeDetailModal()" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded font-medium transition-colors">
                    Tutup
                </button>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-medium transition-colors">
                    Edit
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Data detail transaksi
const transactionDetails = {
    '1': {
        tanggal: '15/01/2024',
        kategori: 'Sewa Properti',
        keterangan: 'Sewa Rumah A - Januari',
        jumlah: 'Rp 2.500.000',
        tipe: 'Pemasukan',
        properti: 'Rumah Type A - Jl. Sudirman No. 123',
        penyewa: 'Budi Santoso',
        periode: 'Januari 2024'
    },
    '2': {
        tanggal: '20/01/2024',
        kategori: 'Maintenance',
        keterangan: 'Perbaikan AC Rumah A',
        jumlah: 'Rp 750.000',
        tipe: 'Pengeluaran',
        properti: 'Rumah Type A - Jl. Sudirman No. 123',
        vendor: 'CV. Sejuk Dingin',
        catatan: 'Penggantian kompressor AC ruang tamu'
    },
    '3': {
        tanggal: '15/02/2024',
        kategori: 'Sewa Properti',
        keterangan: 'Sewa Rumah B - Februari',
        jumlah: 'Rp 3.000.000',
        tipe: 'Pemasukan',
        properti: 'Rumah Type B - Jl. Gatot Subroto No. 456',
        penyewa: 'Siti Aminah',
        periode: 'Februari 2024'
    },
    '4': {
        tanggal: '28/02/2024',
        kategori: 'Operasional',
        keterangan: 'Biaya Listrik & Air',
        jumlah: 'Rp 450.000',
        tipe: 'Pengeluaran',
        properti: 'Semua Properti',
        rincian: 'Listrik: Rp 300.000, Air: Rp 150.000'
    },
    '5': {
        tanggal: '15/03/2024',
        kategori: 'Sewa Properti',
        keterangan: 'Sewa Apartemen C - Maret',
        jumlah: 'Rp 4.000.000',
        tipe: 'Pemasukan',
        properti: 'Apartemen Tower C - Jl. HR Rasuna Said',
        penyewa: 'PT. Maju Bersama',
        periode: 'Maret 2024'
    }
};

function showDetailModal(id) {
    const detail = transactionDetails[id];
    if (!detail) return;
    
    const modalContent = document.getElementById('modalContent');
    modalContent.innerHTML = `
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div class="font-medium text-gray-700">Tanggal:</div>
            <div class="text-gray-900">${detail.tanggal}</div>
            
            <div class="font-medium text-gray-700">Kategori:</div>
            <div class="text-gray-900">${detail.kategori}</div>
            
            <div class="font-medium text-gray-700">Keterangan:</div>
            <div class="text-gray-900">${detail.keterangan}</div>
            
            <div class="font-medium text-gray-700">Jumlah:</div>
            <div class="text-gray-900 font-semibold ${detail.tipe === 'Pemasukan' ? 'text-green-600' : 'text-red-600'}">${detail.jumlah}</div>
            
            <div class="font-medium text-gray-700">Tipe:</div>
            <div class="text-gray-900">${detail.tipe}</div>
            
            <div class="font-medium text-gray-700">Properti:</div>
            <div class="text-gray-900">${detail.properti}</div>
            
            ${detail.penyewa ? `
                <div class="font-medium text-gray-700">Penyewa:</div>
                <div class="text-gray-900">${detail.penyewa}</div>
            ` : ''}
            
            ${detail.vendor ? `
                <div class="font-medium text-gray-700">Vendor:</div>
                <div class="text-gray-900">${detail.vendor}</div>
            ` : ''}
            
            ${detail.periode ? `
                <div class="font-medium text-gray-700">Periode:</div>
                <div class="text-gray-900">${detail.periode}</div>
            ` : ''}
            
            ${detail.catatan ? `
                <div class="font-medium text-gray-700">Catatan:</div>
                <div class="text-gray-900">${detail.catatan}</div>
            ` : ''}
            
            ${detail.rincian ? `
                <div class="font-medium text-gray-700">Rincian:</div>
                <div class="text-gray-900">${detail.rincian}</div>
            ` : ''}
        </div>
    `;
    
    document.getElementById('detailModal').classList.remove('hidden');
}

function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('detailModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDetailModal();
    }
});
</script>
@endsection