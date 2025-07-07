<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class CustomerPropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::query()->with('images'); // Mulai dengan query builder

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('location', 'like', "%$search%");
            });
        }

        $properties = $query->latest()->paginate(12); // Panggil paginate di akhir

        return view('customer.properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        $property->load([
            'images',
            'reservations.review.customer'
        ]);

        // Ambil semua ulasan dari properti ini
        $reviews = $property->reservations
            ->pluck('review')
            ->filter(); // Hilangkan null

        $averageRating = $reviews->avg('rating');

        return view('customer.properties.show', compact('property', 'averageRating', 'reviews'));
    }
}
