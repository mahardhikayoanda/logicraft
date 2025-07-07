@extends('layouts.guest')

@section('title', 'Verifikasi Email')

@section('content')
    <section class="flex items-center justify-center min-h-[60vh] py-16 px-4 bg-white">
        <div class="max-w-xl mx-auto bg-white shadow-lg rounded-lg p-8 text-center animate-on-scroll">
            @if (Auth::user()->hasVerifiedEmail())
                <div class="text-green-600 text-5xl mb-4">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                    Email Anda Telah Diverifikasi!
                </h1>
                <p class="text-gray-600 mb-6">
                    Terima kasih telah memverifikasi alamat email Anda. Akun Anda kini telah aktif dan siap digunakan.
                </p>
                <a href="{{ route('dashboard') }}"
                    class="inline-block px-6 py-3 bg-primary-600 text-white font-semibold rounded-lg hover:bg-primary-700 transition duration-300">
                    Lanjut ke Dashboard
                </a>
            @else
                <div class="text-yellow-500 text-5xl mb-4">
                    <i class="fas fa-envelope-open-text"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4">
                    Verifikasi Email Anda
                </h1>
                <p class="text-gray-600 mb-6">
                    Kami telah mengirimkan link verifikasi ke email Anda: <strong>{{ Auth::user()->email }}</strong>.
                    Jika Anda belum menerima email, klik tombol di bawah untuk kirim ulang.
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 text-sm text-green-600">
                        Link verifikasi baru telah dikirim ke email Anda.
                    </div>
                @endif

                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button>
                        {{ __('Kirim Ulang Email Verifikasi') }}
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="underline text-sm text-gray-600 hover:text-primary-600">
                        Keluar
                    </button>
                </form>
            @endif
        </div>
    </section>
@endsection
