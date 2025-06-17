<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-3xl bg-white shadow-md rounded-xl overflow-hidden flex flex-col lg:flex-row">

            <!-- Left Branding -->
            <div class="bg-gray-50 lg:w-1/2 flex flex-col items-center justify-center p-6 text-center">
                <img src="{{ asset('rb-logo.png') }}" alt="Logo" class="h-20 mb-4">
                <h2 class="text-xl font-bold mb-1">
                    Book your favorite <span class="text-teal-600">properties</span> with one simple click.
                </h2>
            </div>

            <!-- Right Form -->
            <div class="lg:w-1/2 w-full p-6">
                <h2 class="text-lg font-semibold mb-1">Welcome to <span class="text-black">LalokSumbar.id</span></h2>
                <p class="text-sm text-gray-600 mb-5">Login to continue</p>

                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus
                            class="mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-teal-200 focus:border-teal-400 px-3 py-2 text-sm">
                        @error('email')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" type="password" name="password" required
                            class="mt-1 w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-teal-200 focus:border-teal-400 px-3 py-2 text-sm">
                        @error('password')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <a href="{{ route('password.request') }}" class="text-teal-600 hover:underline">Forgot
                            password?</a>
                    </div>

                    <div>
                        <button type="submit"
                            class="w-full bg-teal-600 text-white font-semibold py-2 rounded hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400 text-sm">
                            LOGIN
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4 text-sm">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-teal-600 hover:underline">Register</a>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
