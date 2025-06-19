<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OwnerController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'Owner') {
            abort(403, 'Akses ditolak. Kamu bukan Owner.');
        }

        $user = Auth::user();
        
        // Data yang sudah ada
        $totalProperties = $user->properties()->count();
        $totalTransactions = Transaction::whereHas('property', fn($q) => $q->where('owner_id', $user->id))->count();
        $totalIncome = Transaction::whereHas('property', fn($q) => $q->where('owner_id', $user->id))
                            ->where('status', 'paid')
                            ->sum('amount');

        // Data tambahan yang diperlukan dashboard
        $activeProperties = $user->properties()->where('status', 'active')->count();
        $occupiedProperties = $user->properties()->where('rental_status', 'occupied')->count();
        
        // Total Revenue (sama dengan totalIncome)
        $totalRevenue = $totalIncome;
        
        // Monthly Revenue (pendapatan bulan ini)
        $monthlyRevenue = Transaction::whereHas('property', fn($q) => $q->where('owner_id', $user->id))
                            ->where('status', 'paid')
                            ->whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->sum('amount');
        
        // Average Rent
        $averageRent = 0;
        if ($totalProperties > 0) {
            $averageRent = $user->properties()->avg('rent_price') ?? 0;
        }
        
        // Occupancy Rate
        $occupancyRate = 0;
        if ($totalProperties > 0) {
            $occupancyRate = round(($occupiedProperties / $totalProperties) * 100, 1);
        }
        
        // Rented Properties (untuk analytics section)
        $rentedProperties = $occupiedProperties;
        
        // Recent Activities (contoh data - sesuaikan dengan kebutuhan)
        $recentActivities = $this->getRecentActivities($user->id);

        return view('owner.dashboard', compact(
            'totalProperties', 
            'totalTransactions', 
            'totalIncome',
            'activeProperties',
            'occupiedProperties',
            'totalRevenue',
            'monthlyRevenue',
            'averageRent',
            'occupancyRate',
            'rentedProperties',
            'recentActivities'
        ));
    }

    private function getRecentActivities($ownerId)
    {
        // Ambil transaksi terbaru sebagai aktivitas
        $recentTransactions = Transaction::whereHas('property', fn($q) => $q->where('owner_id', $ownerId))
                                ->orderBy('created_at', 'desc')
                                ->limit(5)
                                ->get();
        
        $activities = [];
        foreach ($recentTransactions as $transaction) {
            $activities[] = [
                'title' => 'Pembayaran Diterima',
                'description' => 'Properti: ' . $transaction->property->name . ' - Rp ' . number_format($transaction->amount, 0, ',', '.'),
                'time' => $transaction->created_at->diffForHumans()
            ];
        }
        
        // Jika tidak ada transaksi, buat contoh aktivitas kosong
        if (empty($activities)) {
            return [];
        }
        
        return $activities;
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