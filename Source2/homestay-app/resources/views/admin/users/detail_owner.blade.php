<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-gray-800">Detail Owner: {{ $user->name }}</h2>
    </x-slot>

    <div class="py-4 px-6">
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Total Properti:</strong> {{ $totalProperties }}</p>
        <p><strong>Total Pendapatan:</strong> Rp{{ number_format($totalIncome, 0, ',', '.') }}</p>

        <h3 class="mt-6 font-semibold text-lg">Daftar Properti:</h3>
        <ul class="list-disc pl-5 mt-2">
            @foreach ($properties as $property)
                <li>{{ $property->name }} -
                    Rp{{ number_format($property->reservations()->sum('total_price'), 0, ',', '.') }}</li>
            @endforeach
        </ul>

        <a href="{{ route('admin.users.byRole', 'owner') }}" class="mt-6 inline-block text-blue-600 hover:underline">←
            Kembali</a>
    </div>
</x-app-layout>
