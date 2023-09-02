<?php

namespace Database\Factories;

use App\Models\food;
use App\Models\recipe;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\favorite>
 */
class FavoriteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_id' => food::factory()->create(),
            'recipe_id' => recipe::factory()->create(),
            'user_id' => User::factory()->create(),
        ];
    }
}
