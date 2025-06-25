<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1 admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => 'admin',
        ]);

        // 1 owner
        User::factory()->create([
            'name' => 'Owner User',
            'email' => 'owner@example.com',
            'role' => 'owner',
        ]);

        // 1 customer
        User::factory()->create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'role' => 'customer',
        ]);

        User::factory()->create([
            'name' => 'Resepsionis User',
            'email' => 'resepsionis@example.com',
            'role' => 'resepsionis',
        ]);

        // Tambahan: generate 10 customer random
        User::factory()->count(10)->create([
            'role' => 'customer',
        ]);
    }
}
