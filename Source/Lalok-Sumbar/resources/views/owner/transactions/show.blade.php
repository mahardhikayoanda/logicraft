<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of transactions for the authenticated owner.
     * Implements UC-See-305 steps 3-6
     */
    public function index(Request $request)
    {
        // Step 4: Sistem mengambil data transaksi terkait akun Owner dari database
        $query = Transaction::with(['property', 'customer'])
            ->whereHas('property', function ($q) {
                $q->where('owner_id', Auth::id());
            })
            ->orderBy('created_at', 'desc');

        // Step 6: Owner dapat menggunakan filter untuk menyaring data transaksi
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by property name or customer name
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereHas('property', function ($subQ) use ($searchTerm) {
                    $subQ->where('name', 'like', "%{$searchTerm}%");
                })
                ->orWhereHas('customer', function ($subQ) use ($searchTerm) {
                    $subQ->where('name', 'like', "%{$searchTerm}%");
                });
            });
        }

        // Step 5: Sistem menampilkan daftar transaksi kepada Owner
        $transactions = $query->paginate(10);

        // Add summary statistics
        $totalTransactions = $query->count();
        $totalAmount = $query->where('status', 'selesai')->sum('amount');
        $pendingCount = Transaction::whereHas('property', function ($q) {
                $q->where('owner_id', Auth::id());
            })
            ->where('status', 'pending')
            ->count();

        return view('transactions.index', compact(
            'transactions', 
            'totalTransactions', 
            'totalAmount', 
            'pendingCount'
        ));
    }

    /**
     * Display the specified transaction details.
     * Implements UC-See-305 steps 7-8
     */
    public function show(Transaction $transaction)
    {
        // Verify that the transaction belongs to the authenticated owner
        if ($transaction->property->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized access to transaction data.');
        }

        // Load necessary relationships
        $transaction->load(['property', 'customer']);

        // Step 8: Sistem menampilkan detail transaksi
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Get transaction statistics for dashboard
     */
    public function getStats()
    {
        $stats = [
            'total_transactions' => Transaction::whereHas('property', function ($q) {
                $q->where('owner_id', Auth::id());
            })->count(),
            
            'total_revenue' => Transaction::whereHas('property', function ($q) {
                $q->where('owner_id', Auth::id());
            })
            ->where('status', 'selesai')
            ->sum('amount'),
            
            'pending_transactions' => Transaction::whereHas('property', function ($q) {
                $q->where('owner_id', Auth::id());
            })
            ->where('status', 'pending')
            ->count(),
            
            'monthly_revenue' => Transaction::whereHas('property', function ($q) {
                $q->where('owner_id', Auth::id());
            })
            ->where('status', 'selesai')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount'),
        ];

        return response()->json($stats);
    }

    /**
     * Update transaction status (if needed for owner actions)
     */
    public function updateStatus(Request $request, Transaction $transaction)
    {
        // Verify ownership
        if ($transaction->property->owner_id !== Auth::id()) {
            abort(403, 'Unauthorized access to transaction data.');
        }

        $request->validate([
            'status' => 'required|in:pending,selesai,dibatalkan'
        ]);

        $transaction->update([
            'status' => $request->status
        ]);

        return redirect()->route('transactions.show', $transaction)
            ->with('success', 'Status transaksi berhasil diperbarui.');
    }
}