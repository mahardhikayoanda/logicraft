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

        $properties = $query->latest()->paginate(12);

        return view('guest.properties.index', compact('properties'));
    }

    public function show($id)
    {
        $property = Property::with('images')->findOrFail($id);
        $property->load([
            'images',
            'reservations.review.customer'
        ]);

        // Ambil semua ulasan dari properti ini
        $reviews = $property->reservations
            ->pluck('review')
            ->filter(); // Hilangkan null

        $averageRating = $reviews->avg('rating');
        return view('guest.properties.show', compact('property', 'averageRating', 'reviews'));
    }

    public function home(Request $request)
    {
        $promotions = Promotion::whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->latest()
            ->get();

        $query = Property::with('images')
            ->where('is_available', true)
            ->latest();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $properties = $query->paginate(6);

        return view('guest.home', compact('promotions', 'properties'));
    }
}
