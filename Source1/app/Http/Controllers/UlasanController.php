<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{

    public function index()
    {
        $ulasan = Ulasan::latest();
        return view('reviews', compact('ulasan'));
    }

    public function store(Request $request, )
    {
        $request->validate([
            'penginapan_id' => 'required|exists:penginapans,id',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        Ulasan::create([
            'user_id' => Auth::id(),
            'penginapan_id' => $request->penginapan_id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        // dd('request');
        return redirect()->back()->with('success', 'Ulasan berhasil dikirim.');
    }



    
}
