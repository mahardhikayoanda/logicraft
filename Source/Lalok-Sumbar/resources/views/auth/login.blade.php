<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - LalokSumbar.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #a0c4ff, #ffd6a5, #caffbf);
            background-size: 600% 600%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px) scale(0.98);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out both;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen px-4 py-8">

    <div class="w-full max-w-lg bg-white bg-opacity-90 rounded-3xl shadow-xl border border-gray-200 p-6 sm:p-8 relative animate-fade-in transition-transform hover:scale-105 hover:shadow-2xl duration-300">

        <!-- Decorative animated circle -->
        <div class="absolute -top-8 -left-8 w-24 h-24 sm:w-32 sm:h-32 bg-gradient-to-tr from-purple-300 via-blue-300 to-green-300 rounded-full blur-xl opacity-20 animate-pulse-slow -z-10"></div>

        <!-- Title -->
        <h2 class="text-2xl sm:text-3xl font-extrabold text-center mb-4 text-gray-800">Selamat Datang!</h2>
        <p class="text-center text-gray-600 mb-6 sm:mb-8 text-sm sm:text-base">Masuk untuk melanjutkan ke <strong>LalokSumbar.id</strong></p>

        <!-- Flash Message Error -->
        @if(session('error'))
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded-lg border border-red-300 shadow-md transition-transform hover:scale-105">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 mb-2 font-semibold text-sm sm:text-base">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 hover:shadow-md hover:translate-y-0.5 text-sm sm:text-base" placeholder="Masukkan email kamu" />
            </div>

            <div>
                <label for="password" class="block text-gray-700 mb-2 font-semibold text-sm sm:text-base">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition duration-200 hover:shadow-md hover:translate-y-0.5 text-sm sm:text-base" placeholder="Masukkan password" />
            </div>

            <div class="flex flex-col sm:flex-row justify-between items-center text-sm mb-4">
                <label class="flex items-center mb-2 sm:mb-0">
                    <input type="checkbox" name="remember" class="mr-2 rounded focus:ring-2 focus:ring-blue-400" />
                    <span class="text-gray-700">Ingat saya</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline font-medium">Lupa password?</a>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-semibold py-3 px-6 rounded-xl shadow-lg transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 text-sm sm:text-base">
                Masuk
            </button>
        </form>

        <p class="text-center text-gray-600 text-sm mt-6 sm:mt-8">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">Daftar sekarang</a>
        </p>
    </div>

</body>

</html>
