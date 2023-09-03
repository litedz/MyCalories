<?php

namespace Tests\Feature;

use App\Livewire\Foods;
use App\Models\food;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UserTest extends TestCase
{

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
        $this->actingAs(User::factory()->create());
        $food = food::get()->random();
        Livewire::test('Foods', ['id' => '1'])
            ->call('AddToFavorite', 1)
            ->assertStatus(200);
    }
    public function test_user_can_add_food_list()
    {
        $this->actingAs(User::factory()->create());

        $food = food::get()->random();

        Livewire::test('Foods', ['id' => '1'])
            ->call('AddFoodToList', 1)
            ->assertStatus(200);
    }

    
}
