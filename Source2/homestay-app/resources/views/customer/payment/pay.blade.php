@extends('layouts.customer')

@section('title', 'Pembayaran')

@section('content')
    <h2 class="text-xl font-bold mb-4">Pembayaran untuk {{ $reservation->property->name }}</h2>

    <p>Total: <strong>Rp {{ number_format($reservation->total_price) }}</strong></p>

    <button id="pay-button" class="mt-4 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
        Bayar Sekarang
    </button>

    <form id="payment-form" method="POST" action="">
        @csrf
        <input type="hidden" name="json" id="json_callback">
    </form>
@endsection

@section('scripts')
    {{-- Midtrans Snap JS --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.getElementById('pay-button').addEventListener('click', function() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Pembayaran berhasil!");
                    console.log("Success:", result);
                    // TODO: redirect atau simpan hasil pembayaran ke server jika perlu
                },
                onPending: function(result) {
                    alert("Menunggu penyelesaian pembayaran.");
                    console.log("Pending:", result);
                },
                onError: function(result) {
                    alert("Terjadi kesalahan pembayaran.");
                    console.log("Error:", result);
                },
                onClose: function() {
                    alert('Anda menutup popup pembayaran.');
                }
            });
        });
    </script>
@endsection
