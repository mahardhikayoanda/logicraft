<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Daftar Properti</h2>
    </x-slot>

    <div class="py-4 px-6">
        <a href="{{ route('owner.properties.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Properti</a>

        @if(session('success'))
            <div class="text-green-600 mt-4">{{ session('success') }}</div>
        @endif

        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Deskripsi</th>
                    <th class="px-4 py-2 border">Harga</th>
                    <th class="px-4 py-2 border">Alamat</th>
                    <th class="px-4 py-2 border">Fasilitas</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($properties as $property)
                    <tr>
                        <td class="border px-4 py-2">{{ $property->name }}</td>
                        <td class="border px-4 py-2">{{ $property->description }}</td>
                        <td class="border px-4 py-2">Rp {{ number_format($property->price_per_night) }}</td>
                        <td class="border px-4 py-2">{{ $property->location }}</td>
                        <td class="border px-4 py-2">{{ $property->facilities }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('owner.properties.show', $property) }}" class="text-yellow-600">Detail</a> |
                            <form action="{{ route('owner.properties.destroy', $property) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center py-4">Belum ada properti.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
