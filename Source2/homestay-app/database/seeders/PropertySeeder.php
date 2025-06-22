<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        // Ambil semua user dengan role "owner"
        $owners = User::where('role', 'owner')->get();

        foreach ($owners as $owner) {
            // Buatkan 3 properti untuk setiap owner
            Property::factory()->count(3)->create([
                'owner_id' => $owner->id,
            ]);
        }
    }
}
