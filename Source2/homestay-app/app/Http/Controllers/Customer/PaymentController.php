<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;

class PaymentController extends Controller
{
    public function pay($reservationId)
    {
        $reservation = Reservation::with('property')->where('customer_id', Auth::id())->findOrFail($reservationId);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Buat parameter transaksi
        $params = [
            'transaction_details' => [
                'order_id' => 'RESV-' . $reservation->id . '-' . time(),
                'gross_amount' => (int) $reservation->total_price,
            ],
            'customer_details' => [
                'first_name' => $reservation->nama_lengkap,
                'email' => $reservation->email,
                'phone' => $reservation->no_hp,
            ],
        ];

        // Generate Snap Token
        $snapToken = Snap::getSnapToken($params);

        return view('customer.payment.pay', compact('reservation', 'snapToken'));
    }
}
