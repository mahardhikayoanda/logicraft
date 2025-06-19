<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::where('customer_id', Auth::id())->with('property')->latest()->get();
        return view('customer.reservations.index', compact('reservations'));
    }

    public function create(Property $property)
    {
        return view('customer.reservations.create', compact('property'));
    }

    public function store(Request $request, Property $property)
    {
        $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'jumlah_tamu' => 'required|integer|min:1',
        ]);

        $conflict = Reservation::where('property_id', $property->id)
            ->where('status', '!=', 'canceled') // Abaikan yang sudah dibatalkan
            ->where(function ($query) use ($request) {
                $query->whereBetween('check_in_date', [$request->check_in_date, $request->check_out_date])
                    ->orWhereBetween('check_out_date', [$request->check_in_date, $request->check_out_date])
                    ->orWhere(function ($query2) use ($request) {
                        $query2->where('check_in_date', '<=', $request->check_in_date)
                            ->where('check_out_date', '>=', $request->check_out_date);
                    });
            })
            ->exists();

        if ($conflict) {
            return redirect()->back()->withInput()->with('error', 'Properti ini sudah dibooking pada tanggal tersebut.');
        }

        $checkIn = Carbon::parse($request->check_in_date);
        $checkOut = Carbon::parse($request->check_out_date);
        $days = $checkIn->diffInDays($checkOut);
        $totalPrice = $days * $property->price_per_night;

        Reservation::create([
            'customer_id'     => Auth::id(),
            'property_id'     => $property->id,
            'check_in_date'   => $checkIn,
            'check_out_date'  => $checkOut,
            'total_price'     => $totalPrice,
            'status'          => 'pending',
            'nama_lengkap'    => $request->nama_lengkap,
            'email'           => $request->email,
            'no_hp'           => $request->no_hp,
            'jumlah_tamu'     => $request->jumlah_tamu,
        ]);

        $property->update(['is_available' => false]);

        return redirect()->route('customer.reservations.history')->with('success', 'Reservasi berhasil dibuat.');
    }



    public function history()
    {
        $reservations = Reservation::with('property')->where('customer_id', Auth::id())->latest()->get();
        return view('customer.reservations.history', compact('reservations'));
    }

    // Tampilkan form edit reservasi
    public function edit(Reservation $reservation)
    {
        if (Auth::id() !== $reservation->customer_id || $reservation->status !== 'pending') {
            abort(403);
        }

        return view('customer.reservations.edit', compact('reservation'));
    }

    // Proses update reservasi
    public function update(Request $request, Reservation $reservation)
    {
        if (Auth::id() !== $reservation->customer_id || $reservation->status !== 'pending') {
            abort(403);
        }

        $request->validate([
            'check_in_date' => 'required|date|after_or_equal:today',
            'check_out_date' => 'required|date|after:check_in_date',
        ]);

        $checkIn = \Carbon\Carbon::parse($request->check_in_date);
        $checkOut = \Carbon\Carbon::parse($request->check_out_date);
        $days = $checkIn->diffInDays($checkOut);
        $totalPrice = $days * $reservation->property->price_per_night;

        $reservation->update([
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('customer.reservations.history')->with('success', 'Reservasi berhasil diperbarui.');
    }

    // Batalkan reservasi
    public function cancel($id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        if ($reservation->status !== 'pending') {
            return redirect()->back()->with('error', 'Reservasi tidak bisa dibatalkan.');
        }

        $reservation->update([
            'status' => 'canceled'
        ]);

        $reservation->property->update([
            'is_available' => true
        ]);

        return redirect()->route('customer.reservations.history')->with('success', 'Reservasi berhasil dibatalkan.');
    }

    public function destroy($id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('customer_id', Auth::id())
            ->firstOrFail();

        if ($reservation->status !== 'canceled') {
            return redirect()->back()->with('error', 'Hanya reservasi yang dibatalkan yang dapat dihapus.');
        }

        $reservation->delete();

        $reservation->property->update([
            'is_available' => true
        ]);

        return redirect()->route('customer.reservations.history')->with('success', 'Reservasi berhasil dihapus.');
    }

    public function show($id)
    {
        $reservation = Reservation::with('property', 'property.images')
            ->where('customer_id', Auth::id())
            ->findOrFail($id);

        return view('customer.reservations.show', compact('reservation'));
    }
}
