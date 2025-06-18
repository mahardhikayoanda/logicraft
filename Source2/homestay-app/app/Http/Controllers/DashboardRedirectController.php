<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardRedirectController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.users.dashboard'),
            'owner' => redirect()->route('owner.dashboard'),
            'receptionist' => redirect()->route('resepsionis.dashboard'),
            'customer' => redirect()->route('customer.dashboard'),
            default => abort(403, 'Role tidak dikenal'),
        };
    }
}

