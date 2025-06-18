<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::with('images')->latest()->get();
        return view('resepsionis.index', compact('properties'));
    }

    public function updateAvailability(Request $request, Property $property)
    {
        $property->is_available = $request->has('is_available');
        $property->save();

        return back()->with('success', 'Status ketersediaan properti berhasil diperbarui.');
    }
}
