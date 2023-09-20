<?php

namespace Database\Seeders;

use App\Models\categorie_food;
use Illuminate\Database\Seeder;

class CategorieFoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $foods = ['اللحوم والبروتينات', 'فواكه', 'خضروات', 'منتجات الحبوب', 'منتجات الألبان', 'زيوت ودهون', 'مكسرات وبذور', 'حلويات ومعجنات', 'مشروبات', 'مأكولات خاصة'];
        foreach ($foods as $key => $value) {
            $create_food = categorie_food::create([
                'name' => $value,
                'image' => fake()->filePath(),
            ]);
        }
    }
}
