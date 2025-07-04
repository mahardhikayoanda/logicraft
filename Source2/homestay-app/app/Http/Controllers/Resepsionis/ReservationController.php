<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['customer', 'property'])->latest()->paginate(10);
        return view('resepsionis.reservation.index', compact('reservations'));
    }
}
