<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome | LalokSumbar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen flex items-center justify-center px-4">
    <div class="flex flex-col lg:flex-row w-full max-w-6xl shadow-md rounded-lg overflow-hidden">
        <!-- Left -->
        <div class="w-full lg:w-1/2 bg-[#e6f7f8] flex flex-col items-center justify-center p-10">
            <img src="{{ asset('rb-logo.png') }}" alt="Ontime Illustration" class="w-60 mb-6">
            <h1 class="text-4xl font-bold text-gray-800 text-center leading-tight">
                Welcome to <span class="text-red-500"> LalokSumbar.id</span>
            </h1>
            <p class="text-center text-gray-600 mt-3 text-sm max-w-sm">Book your favorite
                    properties with one simple click.</p>
        </div>

        <!-- Right -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-10 space-y-4">
            <h2 class="text-2xl font-semibold text-gray-800">Get Started</h2>
            <div class="flex gap-4">
                <a href="{{ route('login') }}"
                    class="px-6 py-2 bg-teal-600 text-white rounded hover:bg-teal-700 transition">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="px-6 py-2 border border-teal-600 text-teal-600 rounded hover:bg-teal-100 transition">Register</a>
                @endif
            </div>
        </div>
    </div>
</body>

</html>
