<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use Midtrans\Notification;
use Midtrans\Config;

class PaymentNotificationController extends Controller
{
    public function handle(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        $notif = new Notification();

        $transactionStatus = $notif->transaction_status;
        $orderId = $notif->order_id;

        // Ambil ID reservasi dari order_id (formatnya: ORDER-<id>-timestamp)
        $segments = explode('-', $orderId);
        $reservationId = $segments[1] ?? null;

        if (!$reservationId) {
            return response()->json(['message' => 'Invalid order ID'], 400);
        }

        $reservation = Reservation::find($reservationId);
        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        if ($transactionStatus === 'settlement' || $transactionStatus === 'capture') {
            $reservation->status = 'confirmed';
        } elseif ($transactionStatus === 'pending') {
            $reservation->status = 'pending';
        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $reservation->status = 'canceled';
        }

        $reservation->save();

        return response()->json(['message' => 'Callback processed']);
    }
}
