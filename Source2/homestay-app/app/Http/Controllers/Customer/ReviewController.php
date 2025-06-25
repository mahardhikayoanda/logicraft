<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($reservationId)
    {
        $reservation = Reservation::with('property')->where('id', $reservationId)
            ->where('customer_id', Auth::id())
            ->where('status', 'confirmed')
            ->firstOrFail();

        // Cek jika sudah pernah review
        if ($reservation->review) {
            return redirect()->route('customer.reservations.history')->with('error', 'Reservasi ini sudah diulas.');
        }

        return view('customer.reviews.create', compact('reservation'));
    }

    public function store(Request $request, $reservationId)
    {
        $reservation = Reservation::where('id', $reservationId)
            ->where('customer_id', Auth::id())
            ->where('status', 'confirmed')
            ->firstOrFail();

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'reservation_id' => $reservation->id,
            'property_id' => $reservation->property_id,
            'customer_id' => Auth::id(),
            'rating' => $request->rating,
            'review' => $request->comment,
        ]);

        return redirect()->route('customer.reservations.history')->with('success', 'Ulasan berhasil dikirim.');
    }

    public function update(Request $request, Review $review)
    {
        if ($review->customer_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $review->update([
            'rating' => $request->rating,
            'review' => $request->comment,
        ]);

        return redirect()->route('customer.reservations.history')->with('success', 'Ulasan berhasil diperbarui.');
    }
}
