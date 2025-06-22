<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\PropertyImage;

class PropertyImageSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::all();

        foreach ($properties as $property) {
            // Tambahkan 3 gambar per properti
            PropertyImage::factory()->count(3)->create([
                'property_id' => $property->id,
            ]);
        }
    }
}
