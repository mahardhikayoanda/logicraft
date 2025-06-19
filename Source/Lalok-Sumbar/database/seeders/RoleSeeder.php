<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat roles
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'owner']);
        Role::firstOrCreate(['name' => 'pelanggan']);

        // Assign role ke user id 1 sebagai contoh
        $user = User::find(1);
        if ($user && !$user->hasRole('admin')) {
            $user->assignRole('admin');
        }

        // Assign role ke user id 2 sebagai owner (jika ada)
        $owner = User::find(2);
        if ($owner && !$owner->hasRole('owner')) {
            $owner->assignRole('owner');
        }

        // Assign role ke user id 3 sebagai pelanggan (jika ada)
        $pelanggan = User::find(3);
        if ($pelanggan && !$pelanggan->hasRole('pelanggan')) {
            $pelanggan->assignRole('pelanggan');
        }
    }
}
