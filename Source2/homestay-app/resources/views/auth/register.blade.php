<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <!-- Pastikan viewport diatur -->
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Gradient bergerak di background halaman */
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Animasi masuk form */
        @keyframes fadeInSlide {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        /* Class untuk background gradient bergerak */
        .bg-gradient-animated {
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        /* Class untuk animasi masuk form */
        .animate-fadeInSlide {
            animation: fadeInSlide 1s ease-out forwards;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-animated px-4">

    <!-- Card form dengan efek hover dan bayangan -->
    <div class="w-full max-w-md bg-white bg-opacity-90 rounded-3xl shadow-xl p-6 sm:p-8 opacity-0 animate-fadeInSlide" style="animation-delay: 0.2s;">
        <!-- Decorative animated circle -->
        <div class="absolute -top-8 -left-8 w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-tr from-purple-300 via-blue-300 to-green-300 rounded-full blur-xl opacity-20 animate-pulse-slow -z-10"></div>

        <!-- Title -->
        <h2 class="text-2xl sm:text-3xl font-extrabold text-center mb-4 text-gray-800">Buat Akun Baru</h2>
        <p class="text-center text-gray-600 mb-6 sm:mb-8 text-sm sm:text-base">Masuk untuk melanjutkan ke <strong>LalokSumbar.id</strong></p>

        <!-- Flash Message Error -->
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 p-3 rounded-lg border border-red-300 shadow-md transition-transform hover:scale-105 duration-200">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Nama -->
            <div>
                <label for="name" class="block text-gray-700 mb-1 font-medium text-sm sm:text-base">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 shadow-sm hover:shadow-md"/>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 mb-1 font-medium text-sm sm:text-base">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 shadow-sm hover:shadow-md"/>
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-gray-700 mb-1 font-medium text-sm sm:text-base">Role</label>
                <select id="role" name="role" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 shadow-sm hover:shadow-md">
                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>-- Pilih Role --</option>
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="cwner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                </select>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-gray-700 mb-1 font-medium text-sm sm:text-base">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 shadow-sm hover:shadow-md"/>
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block text-gray-700 mb-1 font-medium text-sm sm:text-base">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 shadow-sm hover:shadow-md"/>
            </div>

            <!-- Tombol daftar -->
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-semibold py-3 px-6 rounded-xl shadow-lg transition-transform hover:scale-105 hover:shadow-xl">
                Daftar
            </button>
        </form>

        <p class="mt-6 text-center text-gray-600 text-sm">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">Login</a>
        </p>
    </div>

</body>
</html>
