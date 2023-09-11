<?php

namespace Database\Factories;

use App\Enums\activitys;
use App\Enums\BMI_categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'bmi' => fake()->numberBetween(1, 3500),
            'bmr' => fake()->numberBetween(1, 3500),
            'sex' => fake()->randomElement(['men', 'woman']),
            'height' => fake()->numberBetween(1, 3500),
            'unitheight' => fake()->randomElement(['cm', 'inch']),
            'weight' => fake()->numberBetween(1, 3500),
            'unitWeight' => fake()->randomElement(['kg', 'pound']),
            'age' => fake()->numberBetween(15, 100),
            'activity' => fake()->randomElement(array_column(activitys::cases(), 'name')),
            'result' => fake()->randomElement(array_column(BMI_categorie::cases(), 'name')),
        ];
    }
}
