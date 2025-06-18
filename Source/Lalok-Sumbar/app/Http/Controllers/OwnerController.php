<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'Owner') {
        abort(403, 'Akses ditolak. Kamu bukan Owner.');
        }

        $user = Auth::user();
        $totalProperties = $user->properties()->count();
        $totalTransactions = Transaction::whereHas('property', fn($q) => $q->where('owner_id', $user->id))->count();
        $totalIncome = Transaction::whereHas('property', fn($q) => $q->where('owner_id', $user->id))
                            ->where('status', 'paid')
                            ->sum('amount');

        return view('owner.dashboard', compact('totalProperties', 'totalTransactions', 'totalIncome'));
    }

    public function properties()
    {
        $properties = Property::where('owner_id', Auth::id())->get();
        return view('owner.properties.index', compact('properties'));
    }

    public function transactions()
    {
        $transactions = Transaction::whereHas('property', function ($q) {
            $q->where('owner_id', Auth::id());
        })->get();
        return view('owner.transactions.index', compact('transactions'));
    }

    public function bookkeeping()
    {
        $totalIncome = Transaction::whereHas('property', function ($q) {
            $q->where('owner_id', Auth::id());
        })->where('status', 'paid')->sum('amount');

        return view('owner.bookkeeping.index', compact('totalIncome'));
    }
}