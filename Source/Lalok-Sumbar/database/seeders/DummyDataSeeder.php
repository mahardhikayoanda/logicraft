<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DummyDataSeeder extends Seeder
{
    public function run()
    {
        // Cek dan buat owner jika belum ada
        $owner = User::firstOrCreate(
            ['email' => 'owner1@example.com'],
            [
                'name' => 'Owner 1',
                'password' => bcrypt('password'),
                'role' => 'owner'
            ]
        );

        // Cek dan buat customer jika belum ada
        $customer = User::firstOrCreate(
            ['email' => 'customer1@example.com'],
            [
                'name' => 'Customer 1',
                'password' => bcrypt('password'),
                'role' => 'customer'
            ]
        );

        // Buat 3 properti untuk owner (hanya jika belum ada)
        if ($owner->properties()->count() === 0) {
            $properties = Property::factory(3)->create([
                'owner_id' => $owner->id
            ]);

            // Buat transaksi untuk setiap properti
            foreach ($properties as $property) {
                Transaction::create([
                    'property_id' => $property->id,
                    'customer_id' => $customer->id,
                    'amount' => rand(500000, 1000000),
                    'status' => 'paid'
                ]);
            }
        }
    }
}
