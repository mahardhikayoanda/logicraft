<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;

class ReportController extends Controller
{
    public function index()
    {
        $ownerId = Auth::id();

        $properties = Property::with('reservations')
            ->where('owner_id', $ownerId)
            ->get();

        $totalProperties = $properties->count();

        $totalReservations = $properties->sum(function ($property) {
            return $property->reservations->count();
        });

        $totalIncome = $properties->sum(function ($property) {
            return $property->reservations->sum('total_price');
        });

        return view('owner.report.index', compact(
            'properties',
            'totalProperties',
            'totalReservations',
            'totalIncome'
        ));
    }
}
