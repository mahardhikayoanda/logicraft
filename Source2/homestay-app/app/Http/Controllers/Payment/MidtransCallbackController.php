<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Midtrans\Notification;

class MidtransCallbackController extends Controller
{
    public function receive(Request $request)
    {
        // Inisialisasi konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Ambil notifikasi dari Midtrans
        $notification = new Notification();

        $transaction = $notification->transaction_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $orderId = $notification->order_id;

        // Cari reservasi berdasarkan order_id
        $reservation = Reservation::where('id', $orderId)->first();

        if (!$reservation) {
            return response()->json(['message' => 'Reservasi tidak ditemukan'], 404);
        }

        // Handle status dari Midtrans
        if ($transaction == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $reservation->status = 'pending';
                } else {
                    $reservation->status = 'confirmed';
                }
            }
        } elseif ($transaction == 'settlement') {
            $reservation->status = 'confirmed';
        } elseif ($transaction == 'pending') {
            $reservation->status = 'pending';
        } elseif (in_array($transaction, ['deny', 'expire', 'cancel'])) {
            $reservation->status = 'canceled';
        }

        $reservation->save();

        return response()->json(['message' => 'Callback handled successfully']);
    }
}
