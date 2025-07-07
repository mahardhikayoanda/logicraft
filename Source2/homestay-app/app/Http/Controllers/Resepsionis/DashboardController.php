<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('resepsionis.dashboard', [
            'confirmedReservations' => Reservation::where('status', 'confirmed')
                ->count(),

            'canceledReservations' => Reservation::where('status', 'canceled')
                ->count(),

            'pendingReservations' => Reservation::where('status', 'pending')
                ->count(),

            'recentReservations' => Reservation::with(['customer', 'property'])
                ->latest()
                ->take(5)
                ->get()
        ]);
    }
}
