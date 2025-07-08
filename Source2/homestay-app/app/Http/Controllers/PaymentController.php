<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Midtrans\Config;

class PaymentController extends Controller
{
    //
    public function callback()
    {

        Config::$serverKey    = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');
        Config::$isSanitized  = config('services.midtrans.is_sanitized');
        Config::$is3ds        = config('services.midtrans.is_3ds');

        $notif = new \Midtrans\Notification();
        $transaction = $notif->transaction_status == 'settlement' ? 'confirmed':'pending';
        $order_id = explode('-', $notif->order_id)[1];
        $reservation = Reservation::findOrFail($order_id);
        $reservation->update([
            'status' => $transaction,
        ]);

        return response()->json(['message' => 'ok'])->setStatusCode(200);
    }
}
