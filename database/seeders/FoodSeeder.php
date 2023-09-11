<?php

namespace Database\Seeders;

use App\Models\food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        food::factory(20)->create();
    }
}
