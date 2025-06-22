<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'property_id' => 1, // sementara, akan di-override saat seeding
            'image_path' => 'images/properties/' . $this->faker->uuid . '.jpg',
        ];
    }
}
