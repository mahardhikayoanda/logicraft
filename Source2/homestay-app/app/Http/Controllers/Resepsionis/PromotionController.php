<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::latest()->paginate(12);
        return view('resepsionis.promotions.index', compact('promotions'));
    }

    public function create()
    {
        return view('resepsionis.promotions.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

        $data = $request->only(['title', 'start_date', 'end_date', 'description']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('promotions', 'public');
        }

        Promotion::create($data);

        return redirect()->route('resepsionis.promotions.index')->with('success', 'Promosi berhasil ditambahkan');
    }



    public function edit(Promotion $promotion)
    {
        return view('resepsionis.promotions.edit', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'start_date', 'end_date', 'description']);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('promotions', 'public');
        }

        $promotion->update($data);

        return redirect()->route('resepsionis.promotions.index')->with('success', 'Promosi berhasil diupdate');
    }



    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('resepsionis.promotions.index')->with('success', 'Promosi berhasil dihapus');
    }
}
