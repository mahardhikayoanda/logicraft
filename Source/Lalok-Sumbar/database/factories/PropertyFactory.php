<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company . ' Guesthouse',
            'description' => $this->faker->paragraph,
            'owner_id' => 1, // default, bisa di-override waktu create()
            'price' => $this->faker->numberBetween(100000, 500000),
        ];
    }
}
