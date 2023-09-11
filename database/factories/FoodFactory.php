<?php

namespace Database\Factories;

use App\Models\categorie_food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'categorie_food_id' => categorie_food::all()->random()->id,
            'protien' => fake()->numberBetween(0, 200),
            'carbohydrate' => fake()->numberBetween(0, 200),
            'code' => fake()->ean13(),
            'kcal' => fake()->numberBetween(1, 1000),
            'quantity' => fake()->numberBetween(1, 200),
            'unit' => fake()->randomElement(['g', 'kg', 'l', 'ml']),

        ];
    }
}
