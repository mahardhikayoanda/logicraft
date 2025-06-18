<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PropertiesController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        // Middleware dipindahkan ke routes/web.php untuk Laravel 12+
        // $this->middleware('auth'); // HAPUS BARIS INI
    }

    /**
     * Display a listing of the owner's properties.
     */
    public function index(Request $request)
    {
        $query = Property::where('owner_id', Auth::id());

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('rental_status')) {
            $query->where('rental_status', $request->rental_status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        // Order by latest
        $properties = $query->orderBy('created_at', 'desc')->get();

        // If it's an AJAX request, return JSON
        if ($request->ajax()) {
            return response()->json([
                'properties' => $properties,
                'html' => view('owner.properties.partials.property-cards', compact('properties'))->render()
            ]);
        }

        return view('owner.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        return view('owner.properties.create');
    }

    /**
     * Store a newly created property in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'type' => 'required|in:' . implode(',', array_keys(Property::TYPES)),
            'status' => 'required|in:' . implode(',', array_keys(Property::STATUSES)),
            'rental_status' => 'required|in:' . implode(',', array_keys(Property::RENTAL_STATUSES)),
            'bedrooms' => 'nullable|integer|min:0|max:20',
            'bathrooms' => 'nullable|integer|min:0|max:20',
            'area' => 'nullable|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 5),
            'monthly_rent' => 'nullable|numeric|min:0',
            'estimated_value' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'amenities' => 'nullable|array',
            'utilities_included' => 'nullable|array',
            'pet_policy' => 'nullable|boolean',
            'smoking_policy' => 'nullable|boolean',
            'availability_date' => 'nullable|date|after_or_equal:today'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $propertyData = $request->except(['images', '_token']);
        $propertyData['owner_id'] = Auth::id();

        // Handle image uploads
        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('properties', $filename, 'public');
                $images[] = $path;
            }
            $propertyData['images'] = $images;
        }

        $property = Property::create($propertyData);

        return redirect()->route('owner.properties')
            ->with('success', 'Properti berhasil ditambahkan!');
    }

    /**
     * Display the specified property.
     */
    public function show($id)
    {
        $property = Property::where('owner_id', Auth::id())
            ->with(['currentTenant', 'leases', 'transactions', 'maintenanceRequests'])
            ->findOrFail($id);

        return view('owner.properties.show', compact('property'));
    }

    /**
     * Get property details for AJAX requests.
     */
    public function details($id)
    {
        $property = Property::where('owner_id', Auth::id())
            ->with(['currentTenant', 'leases.tenant', 'transactions' => function($query) {
                $query->latest()->limit(10);
            }])
            ->findOrFail($id);

        if (request()->ajax()) {
            return view('owner.properties.partials.property-details', compact('property'))->render();
        }

        return redirect()->route('properties.show', $id);
    }

    /**
     * Show the form for editing the specified property.
     */
    public function edit($id)
    {
        $property = Property::where('owner_id', Auth::id())->findOrFail($id);
        return view('owner.properties.edit', compact('property'));
    }

    /**
     * Update the specified property in storage.
     */
    public function update(Request $request, $id)
    {
        $property = Property::where('owner_id', Auth::id())->findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'type' => 'required|in:' . implode(',', array_keys(Property::TYPES)),
            'status' => 'required|in:' . implode(',', array_keys(Property::STATUSES)),
            'rental_status' => 'required|in:' . implode(',', array_keys(Property::RENTAL_STATUSES)),
            'bedrooms' => 'nullable|integer|min:0|max:20',
            'bathrooms' => 'nullable|integer|min:0|max:20',
            'area' => 'nullable|numeric|min:0',
            'lot_size' => 'nullable|numeric|min:0',
            'year_built' => 'nullable|integer|min:1800|max:' . (date('Y') + 5),
            'monthly_rent' => 'nullable|numeric|min:0',
            'estimated_value' => 'nullable|numeric|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'remove_images' => 'nullable|array',
            'amenities' => 'nullable|array',
            'utilities_included' => 'nullable|array',
            'pet_policy' => 'nullable|boolean',
            'smoking_policy' => 'nullable|boolean',
            'availability_date' => 'nullable|date'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $propertyData = $request->except(['images', 'remove_images', '_token', '_method']);
        
        // Handle existing images removal
        if ($request->filled('remove_images')) {
            $currentImages = $property->images ?? [];
            $imagesToRemove = $request->remove_images;
            
            foreach ($imagesToRemove as $imageToRemove) {
                // Delete from storage
                if (Storage::disk('public')->exists($imageToRemove)) {
                    Storage::disk('public')->delete($imageToRemove);
                }
                // Remove from array
                $currentImages = array_values(array_diff($currentImages, [$imageToRemove]));
            }
            
            $propertyData['images'] = $currentImages;
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $currentImages = $propertyData['images'] ?? $property->images ?? [];
            
            foreach ($request->file('images') as $image) {
                $filename = Str::random(40) . '.' . $image->getClientOriginalExtension();
                $path = $image->storeAs('properties', $filename, 'public');
                $currentImages[] = $path;
            }
            
            $propertyData['images'] = $currentImages;
        }

        $property->update($propertyData);

        return redirect()->route('owner.properties')
            ->with('success', 'Properti berhasil diperbarui!');
    }

    /**
     * Remove the specified property from storage.
     */
    public function destroy($id)
    {
        $property = Property::where('owner_id', Auth::id())->findOrFail($id);

        // Check if property has active leases
        if ($property->currentTenant) {
            return redirect()->back()
                ->with('error', 'Tidak dapat menghapus properti yang sedang disewa.');
        }

        // Delete property images
        if ($property->images) {
            foreach ($property->images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        $property->delete();

        return redirect()->route('owner.properties')
            ->with('success', 'Properti berhasil dihapus!');
    }

    /**
     * Get property statistics for dashboard.
     */
    public function getStatistics()
    {
        $userId = Auth::id();
        
        $stats = [
            'total_properties' => Property::where('owner_id', $userId)->count(),
            'active_properties' => Property::where('owner_id', $userId)->where('status', 'active')->count(),
            'occupied_properties' => Property::where('owner_id', $userId)->where('rental_status', 'occupied')->count(),
            'available_properties' => Property::where('owner_id', $userId)->where('rental_status', 'available')->count(),
            'total_estimated_value' => Property::where('owner_id', $userId)->sum('estimated_value'),
            'monthly_rental_income' => Property::where('owner_id', $userId)
                ->where('rental_status', 'occupied')
                ->sum('monthly_rent'),
            'properties_by_type' => Property::where('owner_id', $userId)
                ->selectRaw('type, COUNT(*) as count')
                ->groupBy('type')
                ->pluck('count', 'type')
                ->toArray(),
            'properties_by_status' => Property::where('owner_id', $userId)
                ->selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray()
        ];

        return response()->json($stats);
    }

    /**
     * Toggle property status (active/inactive).
     */
    public function toggleStatus($id)
    {
        $property = Property::where('owner_id', Auth::id())->findOrFail($id);
        
        $property->status = $property->status === 'active' ? 'inactive' : 'active';
        $property->save();

        $message = $property->status === 'active' 
            ? 'Properti berhasil diaktifkan!' 
            : 'Properti berhasil dinonaktifkan!';

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'new_status' => $property->status
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Update rental status.
     */
    public function updateRentalStatus(Request $request, $id)
    {
        $property = Property::where('owner_id', Auth::id())->findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'rental_status' => 'required|in:' . implode(',', array_keys(Property::RENTAL_STATUSES))
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'Status sewa tidak valid.'], 400);
        }

        $property->rental_status = $request->rental_status;
        $property->save();

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Status sewa berhasil diperbarui!',
                'new_status' => $property->formatted_rental_status
            ]);
        }

        return redirect()->back()->with('success', 'Status sewa berhasil diperbarui!');
    }

    /**
     * Get properties for API or AJAX requests.
     */
    public function apiIndex(Request $request)
    {
        $query = Property::where('owner_id', Auth::id());

        // Apply filters
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        $properties = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $properties->map(function ($property) {
                return [
                    'id' => $property->id,
                    'name' => $property->name,
                    'address' => $property->full_address,
                    'type' => $property->formatted_type,
                    'status' => $property->formatted_status,
                    'rental_status' => $property->formatted_rental_status,
                    'monthly_rent' => $property->monthly_rent,
                    'estimated_value' => $property->estimated_value,
                    'main_image' => $property->main_image ? asset('storage/' . $property->main_image) : null,
                    'created_at' => $property->created_at->format('Y-m-d H:i:s')
                ];
            })
        ]);
    }
}