<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-900">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-4xl bg-white shadow-md rounded-xl overflow-hidden flex flex-col lg:flex-row">

            <!-- Left Branding -->
            <div class="bg-gray-50 lg:w-1/2 flex flex-col items-center justify-center p-6 text-center">
                <img src="{{ asset('rb-logo.png') }}" alt="Logo" class="h-20 mb-4">
                <h2 class="text-xl font-bold mb-1">
                    Create Your <span class="text-teal-600">Account</span>
                </h2>
                <p class="text-xs text-gray-600 px-4">Join us and unlock team productivity with ease.</p>
            </div>

            <!-- Right Form -->
            <!-- Right Form -->
            <div class="lg:w-1/2 w-full p-6">
                <h2 class="text-lg font-semibold mb-1">Register to <span class="text-black">Ontime</span></h2>
                <p class="text-sm text-gray-600 mb-5">Let’s get started with your account</p>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required
                            autofocus
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-teal-200 focus:border-teal-400 px-3 py-2 text-sm">
                        @error('name')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-teal-200 focus:border-teal-400 px-3 py-2 text-sm">
                        @error('email')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700">Register as</label>
                        <select id="role" name="role" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-teal-200 focus:border-teal-400 px-3 py-2 text-sm bg-white">
                            <option value="" disabled selected>-- Select Role --</option>
                            <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                            <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>
                                Customer</option>
                        </select>
                        @error('role')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" type="password" name="password" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-teal-200 focus:border-teal-400 px-3 py-2 text-sm">
                        @error('password')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                            Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-teal-200 focus:border-teal-400 px-3 py-2 text-sm">
                        @error('password_confirmation')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-between text-sm mt-4">
                        <a href="{{ route('login') }}" class="text-teal-600 hover:underline">Already have an
                            account?</a>
                        <button type="submit"
                            class="bg-teal-600 text-white font-semibold py-2 px-4 rounded hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400 text-sm">
                            Register
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

</html>
