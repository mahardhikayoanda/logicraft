<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Promotion;
use Illuminate\Http\Request;

class GuestPropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with('images')->where('is_available', true);

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%");
        }

        $properties = $query->latest()->paginate(6);

        $promotions = Promotion::whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->get();

        return view('guest.properties.index', compact('properties', 'promotions'));
    }

    public function show($id)
    {
        $property = Property::with('images')->findOrFail($id);
        return view('guest.properties.show', compact('property'));
    }

    public function checkAvailability($id)
    {
        $property = Property::findOrFail($id);
        return response()->json([
            'available' => $property->is_available,
            'message' => $property->is_available ? 'Tersedia' : 'Sudah dipesan'
        ]);
    }
}
