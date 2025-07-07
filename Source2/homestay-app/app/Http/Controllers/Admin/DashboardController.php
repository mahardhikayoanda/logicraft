<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'adminCount' => User::where('role', 'admin')->count(),
            'ownerCount' => User::where('role', 'owner')->count(),
            'receptionistCount' => User::where('role', 'resepsionis')->count(),
            'customerCount' => User::where('role', 'customer')->count()
        ]);
    }
}
