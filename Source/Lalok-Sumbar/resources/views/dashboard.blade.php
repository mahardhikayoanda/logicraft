<x-app-layout>
<<<<<<< HEAD
    <x-slot name="header">
<<<<<<< HEAD
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
=======
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Penginapan Bukittinggi') }}
>>>>>>> 151ce2a0cf6529a4f777dc8c567187fc9bcb4912
        </h2>
    </x-slot>
=======
<<<<<<< HEAD
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
=======
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}
>>>>>>> 44538d1b47f2b3204f4552cb58676d525095cd3c
>>>>>>> 765a4fc4999d851864e1c4d0b6864c19e9eb8198

    {{-- <!-- Button Filter -->
    <div class="flex justify-end px-4 mb-4">
        <button class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600">Show All</button>
    </div> --}}

    <!-- Properti dalam baris yang bisa scroll saat mobile -->
    <div class="flex gap-4 px-4 overflow-x-auto whitespace-nowrap">
        {{-- Properti 1 --}}
        <div class="inline-block w-64 bg-white dark:bg-gray-800 rounded-lg shadow p-2 flex flex-col min-h-full">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Properti 1" class="rounded-lg mb-2 h-32 object-cover" />
            <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-2 py-1 rounded mb-1 inline-block">Luxury Villa</span>
            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1 text-sm line-clamp-2">18 Old Street Miami, OR 97219</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-1 text-xs">Bedrooms: 8 | Bathrooms: 8</p>
            <p class="text-gray-700 dark:text-gray-300 mb-1 font-semibold text-sm">Rp2.264.000</p>
            <p class="text-gray-500 dark:text-gray-400 mb-2 text-xs">Area: 545m<sup>2</sup></p>
            <button class="mt-auto bg-black text-white px-2 py-1 rounded text-xs hover:bg-gray-800">Schedule</button>
        </div>
        {{-- Properti 2 --}}
        <div class="inline-block w-64 bg-white dark:bg-gray-800 rounded-lg shadow p-2 flex flex-col min-h-full">
            <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Properti 2" class="rounded-lg mb-2 h-32 object-cover" />
            <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-2 py-1 rounded mb-1 inline-block">Luxury Villa</span>
            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1 text-sm line-clamp-2">54 New Street Florida, OR 27001</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-1 text-xs">Bedrooms: 6 | Bathrooms: 5</p>
            <p class="text-gray-700 dark:text-gray-300 mb-1 font-semibold text-sm">Rp1.180.000</p>
            <p class="text-gray-500 dark:text-gray-400 mb-2 text-xs">Area: 450m<sup>2</sup></p>
            <button class="mt-auto bg-black text-white px-2 py-1 rounded text-xs hover:bg-gray-800">Schedule</button>
        </div>
        {{-- Properti 3 --}}
        <div class="inline-block w-64 bg-white dark:bg-gray-800 rounded-lg shadow p-2 flex flex-col min-h-full">
            <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Properti 3" class="rounded-lg mb-2 h-32 object-cover" />
            <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-2 py-1 rounded mb-1 inline-block">Luxury Villa</span>
            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1 text-sm line-clamp-2">54 New Street Florida, OR 27001</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-1 text-xs">Bedrooms: 6 | Bathrooms: 5</p>
            <p class="text-gray-700 dark:text-gray-300 mb-1 font-semibold text-sm">Rp1.180.000</p>
            <p class="text-gray-500 dark:text-gray-400 mb-2 text-xs">Area: 450m<sup>2</sup></p>
            <button class="mt-auto bg-black text-white px-2 py-1 rounded text-xs hover:bg-gray-800">Schedule</button>
        </div>
        {{-- Properti 4 --}}
        <div class="inline-block w-64 bg-white dark:bg-gray-800 rounded-lg shadow p-2 flex flex-col min-h-full">
            <img src="https://images.unsplash.com/photo-1549924231-f129b911e442?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Properti 4" class="rounded-lg mb-2 h-32 object-cover" />
            <span class="bg-orange-100 text-orange-600 text-xs font-semibold px-2 py-1 rounded mb-1 inline-block">Luxury Villa</span>
            <h3 class="font-semibold text-gray-800 dark:text-gray-200 mb-1 text-sm line-clamp-2">54 New Street Florida, OR 27001</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-1 text-xs">Bedrooms: 6 | Bathrooms: 5</p>
            <p class="text-gray-700 dark:text-gray-300 mb-1 font-semibold text-sm">Rp1.180.000</p>
            <p class="text-gray-500 dark:text-gray-400 mb-2 text-xs">Area: 450m<sup>2</sup></p>
            <button class="mt-auto bg-black text-white px-2 py-1 rounded text-xs hover:bg-gray-800">Schedule</button>
        </div>
    </div>
</x-app-layout>
