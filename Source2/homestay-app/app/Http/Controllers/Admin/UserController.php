<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Property;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Tampilkan semua user
    public function index()
    {
        $users = User::orderBy('name')->get();
        return view('admin.users.index', compact('users'));
    }

    // Tampilkan form tambah user
    public function create()
    {
        return view('admin.users.create');
    }

    // Simpan user baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role'     => 'required|in:admin,owner,resepsionis,customer',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }

    // Tampilkan form edit user
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Simpan perubahan user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:6',
            'role'     => 'required|in:admin,owner,resepsionis,customer',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    // Hapus user
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }

    public function indexByRole($role)
    {
        $users = User::where('role', $role)->get();
        return view('admin.users.index_by_role', compact('users', 'role'));
    }

    public function detailOwner($id)
    {
        $user = User::findOrFail($id);

        // Ambil semua properti milik owner ini
        $properties = Property::where('owner_id', $user->id)->get();

        // Hitung total properti
        $totalProperties = $properties->count();

        // Hitung total pendapatan dari semua reservasi yang statusnya selesai
        $totalIncome = Reservation::whereIn('property_id', $properties->pluck('id'))
            ->where('status', 'selesai')
            ->sum('total_price');

        // Kirim semua variabel ke blade
        return view('admin.users.detail_owner', compact(
            'user',
            'properties',
            'totalProperties',
            'totalIncome'
        ));
    }
}
