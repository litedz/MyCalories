<?php

namespace Tests\Feature;

use App\Models\categorie_food;
use App\Models\food;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_to_calcul_bmi_and_bmr()
    {
        $this->get('/bmi')->assertStatus(200);
    }

    public function test_user_can_see_foods_categorie()
    {
        $this->get('/categories')->assertSeeLivewire('categories');
    }

    public function test_user_can_add_favorite_food()
    {
        $this->seed();

        $food = food::get()->random();
        $categorie_id = categorie_food::get()->random()->id;

        $this->actingAs(User::factory()->create());

        Livewire::test('Foods', ['id' => $categorie_id])
            ->call('AddToFavorite', $food->id)
            ->assertStatus(200);
    }

    public function test_user_can_add_food_list()
    {
        $this->seed();
        $this->actingAs(User::factory()->create());

        $food = food::get()->random();
        $categorie_id = categorie_food::get()->random()->id;

        Livewire::test('Foods', ['id' => $categorie_id])
            ->call('AddFoodToList', $food->id)
            ->assertStatus(200);
    }
}
