<?php

namespace App\Http\Controllers;

use App\Models\Reservasi;
use App\Models\ReservasiDihapus;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    /**
     * Tampilkan daftar reservasi aktif
     */

public function dashboard()
{
    // Ambil semua data reservasi
    $reservasis = Reservasi::all();

    // Kirim ke view
    return view('resepsionis.dashboard', compact('reservasis'));
}

    public function index()
{
    $reservasi = \App\Models\Reservasi::all(); // atau ->select(...) jika perlu
    return view('resepsionis.daftar_reservasi', compact('reservasi'));
}

    /**
     * Tampilkan form tambah reservasi
     */
    public function create()
    {
        return view('resepsionis.tambah_reservasi');
    }

    /**
     * Simpan reservasi baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_tamu' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after_or_equal:tanggal_checkin',
            'tipe_kamar' => 'required|string',
        ]);

        Reservasi::create($validated);

        return redirect()->route('dashboard')->with('success', 'Reservasi berhasil ditambahkan!');
    }

    /**
     * Tampilkan form edit reservasi
     */
    public function edit($id)
    {
        $reservasi = Reservasi::findOrFail($id);
        return view('resepsionis.edit_reservasi', compact('reservasi'));
    }

    /**
     * Simpan perubahan reservasi
     */
    public function update(Request $request, $id)
    {
        $reservasi = Reservasi::findOrFail($id);
        $before = $reservasi->toArray();

        $validated = $request->validate([
            'nama_tamu' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date|after_or_equal:tanggal_checkin',
            'tipe_kamar' => 'required|string',
        ]);

        $reservasi->update($validated);

        return view('resepsionis.hasil_edit', [
            'sebelum' => $before,
            'sesudah' => $reservasi
        ]);
    }

    /**
     * Hapus reservasi dan simpan ke tabel arsip
     */
    public function destroy($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        ReservasiDihapus::create([
            'nama_tamu' => $reservasi->nama_tamu,
            'email' => $reservasi->email,
            'no_hp' => $reservasi->no_hp,
            'tanggal_checkin' => $reservasi->tanggal_checkin,
            'tanggal_checkout' => $reservasi->tanggal_checkout,
            'tipe_kamar' => $reservasi->tipe_kamar,
        ]);

        $reservasi->delete();

        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }

    /**
     * Tampilkan daftar reservasi yang sudah dihapus (arsip)
     */
    public function dihapus()
    {
        $data = ReservasiDihapus::latest()->get();
        return view('resepsionis.reservasi_dihapus', compact('data'));
    }
}
