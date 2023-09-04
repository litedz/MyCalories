<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Favorite;
use App\Livewire\Foods;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        $this->actingAs(User::factory()->create());
        Livewire::test(Favorite::class)
            ->assertStatus(200);
    }

    public function test_user_can_remove_food_from_favorite()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test('Foods', ['id' => '1'])
            ->call('AddToFavorite', 1)
            ->assertStatus(200);

        Livewire::test(Favorite::class)
            ->call('RemoveFoodFromFav', 1)
            ->assertStatus(200);
    }
}
