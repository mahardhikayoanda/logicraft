<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-white min-h-screen flex items-center justify-center px-4 py-12">
    
    <div class="bg-white max-w-sm w-full rounded-3xl shadow-2xl border border-gray-200 relative overflow-hidden" style="aspect-ratio: 2/3;">
        <!-- Outer container with padding -->
        <div class="p-6 md:p-8">
            <!-- Inner content container -->
            <div class="px-8 py-6 md:px-10 md:py-8 h-full">
                <!-- Decorative circles -->
                <div class="absolute -top-10 -left-10 w-24 h-24 bg-blue-100 rounded-full blur-2xl opacity-30"></div>
                <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-blue-200 rounded-full blur-3xl opacity-40"></div>

                <!-- Content -->
                <div class="relative z-10 h-full flex flex-col justify-center">
                    <!-- Header -->
                    <div class="text-center mb-8">
                        <h1 class="text-2xl font-semibold text-gray-900 mb-2">Selamat Datang!</h1>
                        <p class="text-gray-600 text-sm">
                            Masuk untuk melanjutkan ke <span class="font-medium">LalokSumbar.id</span>
                        </p>
                    </div>

                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 text-sm text-green-600 bg-green-50 p-3 rounded-lg">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-6 flex-1 flex flex-col justify-center">
                        @csrf

                        <!-- Email Field -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus
                                placeholder="masukkan email"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm placeholder-gray-400"
                            >
                            @error('email')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                required
                                placeholder="masukkan password"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm placeholder-gray-400"
                            >
                            @error('password')
                                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="text-right">
                            <a href="{{ route('password.request') }}" 
                            class="text-sm text-gray-600 hover:text-gray-800 transition-colors duration-200">
                                lupa password?
                            </a>
                        </div>

                        <!-- Login Button -->
                        <button 
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-xl transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            Masuk
                        </button>
                    </form>

                    <!-- Register Link -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-600">
                            belum punya akun? 
                            <a href="{{ route('register') }}" 
                            class="text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                                Daftar Sekarang
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
