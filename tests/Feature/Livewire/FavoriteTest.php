<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Favorite;
use App\Livewire\Foods;
use App\Models\categorie_food;
use App\Models\food;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function renders_successfully()
    {
        $this->actingAs(User::factory()->create());
        Livewire::test(Favorite::class)
            ->assertStatus(200);
    }

    public function test_user_can_remove_food_from_favorite()
    {

        $this->seed();
        $this->actingAs(User::factory()->create());
        $food = food::get()->random();
        $categorie_id = categorie_food::get()->random()->id;
        Livewire::test('Foods', ['id' => $categorie_id])
            ->call('AddToFavorite', $food->id)
            ->assertStatus(200);

        Livewire::test(Favorite::class)
            ->call('RemoveFoodFromFav', $food->id)
            ->assertStatus(200);
    }
}
