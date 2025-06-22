<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'owner_id' => 1, // sementara, nanti kita isi dinamis di seeder
            'name' => $this->faker->company() . ' Homestay',
            'location' => $this->faker->city(),
            'price_per_night' => $this->faker->numberBetween(200000, 1000000),
            'description' => $this->faker->paragraph(),
            'facilities' => implode(', ', $this->faker->randomElements([
                'WiFi',
                'AC',
                'TV',
                'Kolam Renang',
                'Dapur',
                'Parkir',
                'Kamar Mandi Dalam'
            ], rand(2, 5))),
        ];
    }
}
