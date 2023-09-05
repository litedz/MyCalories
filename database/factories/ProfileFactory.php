<?php

namespace Database\Factories;

use App\Models\favorite;
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



            'bmi' => fake()->numberBetween(1,3500),
            'bmr' => fake()->numberBetween(1,3500),
            'sex' => fake()->randomElement(['men','woman']),
            'height' =>fake()->numberBetween(1,3500),
            'Unit_height' => fake()->randomElement(['cm','inch']),
            'weight' => fake()->numberBetween(1,3500),
            'Unit_weight' => fake()->randomElement(['kg','pound']),
           'age' => fake()->numberBetween(15,100),
            'activity' => fake()->randomElement(['height','low','slowly']),
            'result' => fake()->randomElement(['obess','normal','Tiny']),

        ];
    }
}
