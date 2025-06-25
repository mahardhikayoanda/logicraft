<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class CustomerPropertyController extends Controller
{
    public function index(Request $request)
    {
        $query = Property::with('images'); // Load relasi gambar

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('location', 'like', "%$search%");
            });
        }

        $properties = $query->latest()->get();

        return view('customer.properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        // Load relasi gambar dan reservasi + review
        $property->load(['images', 'reservations.review']);

        // Lalu load relasi review -> customer
        $property->reservations->load('review.customer');

        return view('customer.properties.show', compact('property'));
    }
}
