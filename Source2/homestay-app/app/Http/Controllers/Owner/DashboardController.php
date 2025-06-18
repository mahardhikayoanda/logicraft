<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Property;
use App\Models\Reservation;


class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('owner.dashboard');
    }
}
