<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - LalokSumbar.id</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-white min-h-screen flex items-center justify-center px-4 py-12">

    <div class="bg-white max-w-4xl w-full rounded-3xl shadow-2xl p-10 md:p-14 flex flex-col md:flex-row items-center gap-10 border border-gray-200 relative overflow-hidden">

        <!-- Decorative circle -->
        <div class="absolute -top-10 -left-10 w-36 h-36 bg-blue-100 rounded-full blur-2xl opacity-30"></div>
        <div class="absolute -bottom-10 -right-10 w-48 h-48 bg-blue-200 rounded-full blur-3xl opacity-40"></div>

        <!-- Left: Illustration -->
        <div class="w-full md:w-1/2 animate-fade-in">
            <img src="{{ url('rb-logo.png') }}" alt="LalokSumbar Logo" class="w-full h-auto drop-shadow-md rounded-lg">
        </div>

        <!-- Right: Content -->
        <div class="w-full md:w-1/2 text-center md:text-left animate-slide-up">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 leading-snug mb-3">
                Selamat Datang di <span class="text-blue-600">LalokSumbar.id</span>
            </h1>
            <p class="text-gray-500 mb-6">
                Layanan Penginapan Harian/Mingguan Sekitar Sumatera Barat. Ayo Explore dan Jelajahi keindahan alam Sumatera Barat.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('login') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl w-full shadow transition duration-200 text-center">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                    class="bg-white hover:bg-gray-100 text-gray-700 font-semibold border border-gray-300 py-3 px-6 rounded-xl w-full shadow-sm transition duration-200 text-center">
                    Daftar Akun
                </a>
            </div>
        </div>
    </div>

    <!-- Animations -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: scale(0.98);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out both;
        }

        .animate-slide-up {
            animation: slide-up 0.7s ease-out both;
        }
    </style>

</body>

</html>