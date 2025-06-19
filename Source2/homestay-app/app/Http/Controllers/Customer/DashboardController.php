<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Property;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $customerId = Auth::id();

        $totalReservations = Reservation::where('customer_id', $customerId)->count();
        $upcomingReservations = Reservation::where('customer_id', $customerId)
            ->where('check_in_date', '>', now())
            ->count();

        // Pencarian properti
        $query = Property::where('is_available', true);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $properties = $query->latest()->take(6)->get(); // tampilkan max 6

        return view('customer.dashboard', compact(
            'totalReservations',
            'upcomingReservations',
            'properties'
        ));
    }
}
