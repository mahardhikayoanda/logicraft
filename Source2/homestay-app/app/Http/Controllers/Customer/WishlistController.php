<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    /**
     * Menampilkan semua properti yang ada di wishlist customer.
     */
    public function index()
    {
        $userId = Auth::id();

        $wishlistedProperties = Property::whereHas('wishlistedBy', function ($query) use ($userId) {
            $query->where('customer_id', $userId);
        })->with('images')->get();

        return view('customer.wishlist.index', compact('wishlistedProperties'));
    }

    /**
     * Menambahkan properti ke wishlist customer.
     */
    public function store($propertyId)
    {
        $userId = Auth::id();

        $exists = DB::table('wishlists')
            ->where('customer_id', $userId)
            ->where('property_id', $propertyId)
            ->exists();

        if (!$exists) {
            DB::table('wishlists')->insert([
                'customer_id' => $userId,
                'property_id' => $propertyId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', 'Properti ditambahkan ke wishlist.');
    }

    /**
     * Menghapus properti dari wishlist customer.
     */
    public function destroy($propertyId)
    {
        $userId = Auth::id();

        DB::table('wishlists')
            ->where('customer_id', $userId)
            ->where('property_id', $propertyId)
            ->delete();

        return back()->with('success', 'Properti dihapus dari wishlist.');
    }
}
