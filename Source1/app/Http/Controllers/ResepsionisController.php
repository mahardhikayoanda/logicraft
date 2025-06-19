<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi; // Pastikan model ini sudah ada

class ResepsionisController extends Controller
{
    public function dashboard()
    {
        $reservasis = Reservasi::all(); // Ambil semua data reservasi
        return view('resepsionis.dashboard', compact('reservasis'));
    }
}
