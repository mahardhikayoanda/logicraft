<?php

namespace App\Http\Controllers\Properti;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properti;

class PropertiController extends Controller
{
    //
    public function index()
    {
        //
        return view('operatorDashboard.opDashboard');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'kapasitas' => 'required|string|max:255',
            'fasilitas' => 'required|digits:4|integer',
            'kategori' => 'required|string|max:255',
            'harga' => 'required|integer|min:1',
        ]);

        Properti::create($request->all());

        return redirect()->route('operatorDashboard.opDashboard')->with('success', 'Buku berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Properti $bukus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Properti $buku)
    {
        return view('buku.edit', compact('buku'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Properti $buku)
    {
        $request->validate([
            'judul_buku' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|digits:4|integer',
            'kategori' => 'required|string|max:255',
            'jumlah_halaman' => 'required|integer|min:1',
            'status_baca' => 'required|in:belum dibaca,sedang dibaca,selesai dibaca',
        ]);

        $buku->update($request->all());

        // return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Properti $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }


    public function deleted()
    {
        $bukus = Properti::onlyTrashed()->paginate(10);
        return view('buku.deleted', compact('bukus'));
    }

    public function restore($id)
    {
        $buku = Properti::onlyTrashed()->findOrFail($id);
        $buku->restore();

        return redirect()->route('buku.deleted')->with('success', 'Buku berhasil dipulihkan!');
    }
}
