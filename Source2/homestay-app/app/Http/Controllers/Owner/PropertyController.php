<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::where('owner_id', Auth::id())->latest()->paginate(9);
        return view('owner.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('owner.properties.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required',
            'description'       => 'required',
            'price_per_night'   => 'required|numeric',
            'location'          => 'required',
            'facilities'        => 'required',
            'images.*'          => 'image|mimes:jpg,jpeg,png|max:,5120',
            'latitude'          => 'required|numeric',
            'longitude'         => 'required|numeric'
        ]);

        $property = Property::create([
            'owner_id'          => Auth::id(),
            'name'              => $request->name,
            'description'       => $request->description,
            'price_per_night'   => $request->price_per_night,
            'location'          => $request->location,
            'facilities'        => $request->facilities,
            'latitude'          => $request->latitude,
            'longitude'         => $request->longitude
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('property_images', 'public');
                $property->images()->create([
                    'image_path' => $path
                ]);
            }
        }

        return redirect()->route('owner.properties.index')->with('success', 'Properti berhasil ditambahkan.');
    }

    public function edit(Property $property)
    {
        abort_unless($property->owner_id === Auth::id(), 403);
        $property->load('images');
        return view('owner.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        abort_unless($property->owner_id === Auth::id(), 403);

        $request->validate([
            'name'              => 'required',
            'description'       => 'required',
            'price_per_night'   => 'required|numeric',
            'location'          => 'required',
            'facilities'        => 'required',
            'images.*'          => 'image|mimes:jpg,jpeg,png|max:5120',
            'latitude'          => 'required|numeric',
            'longitude'         => 'required|numeric'
        ]);

        $property->update($request->only(['name', 'description', 'price_per_night', 'location', 'facilities', 'latitude', 'longitude']));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $imageFile) {
                $path = $imageFile->store('property_images', 'public');
                $property->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->route('owner.properties.index')->with('success', 'Properti berhasil diperbarui.');
    }

    public function destroy(Property $property)
    {
        abort_unless($property->owner_id === Auth::id(), 403);

        foreach ($property->images as $img) {
            Storage::disk('public')->delete($img->image_path);
            $img->delete();
        }

        $property->delete();

        return redirect()->route('owner.properties.index')->with('success', 'Properti berhasil dihapus.');
    }

    public function show(Property $property)
    {
        abort_unless($property->owner_id === Auth::id(), 403); // opsional tapi disarankan
        $property->load('images');
        return view('owner.properties.show', compact('property'));
    }
}
