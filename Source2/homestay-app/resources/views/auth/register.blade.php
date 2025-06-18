<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center px-4 py-8">
    
    <div class="bg-white w-full max-w-md rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <!-- Content Container -->
        <div class="p-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-xl font-semibold text-gray-900 mb-1">Buat Akun Baru</h1>
                <p class="text-gray-600 text-sm">masuk untuk lanjut ke LalokSumbar.id</p>
            </div>

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                    <input 
                        id="name" 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required 
                        autofocus
                        placeholder="masukkan nama lengkap"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm placeholder-gray-400"
                    >
                    @error('name')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required
                        placeholder="masukkan email"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm placeholder-gray-400"
                    >
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Role Field -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                    <select 
                        id="role" 
                        name="role" 
                        required
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm bg-white appearance-none"
                        style="background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 4 5%22><path fill=%22%23666%22 d=%22M2 0L0 2h4zm0 5L0 3h4z%22/></svg>'); background-repeat: no-repeat; background-position: right 12px center; background-size: 12px;"
                    >
                        <option value="" disabled selected class="text-gray-400">pilih role</option>
                        <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                        <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    </select>
                    @error('role')
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
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm placeholder-gray-400"
                    >
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
                    <input 
                        id="password_confirmation" 
                        type="password" 
                        name="password_confirmation" 
                        required
                        placeholder="konfirmasi password"
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm placeholder-gray-400"
                    >
                    @error('password_confirmation')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Register Button -->
                <div class="pt-2">
                    <button 
                        type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Daftar
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">
                    sudah punya akun? 
                    <a href="{{ route('login') }}" 
                       class="text-blue-600 hover:text-blue-700 font-medium transition-colors duration-200">
                        Login
                    </a>
                </p>
            </div>
        </div>
    </div>

</body>

</html>
