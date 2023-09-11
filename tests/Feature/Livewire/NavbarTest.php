<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Navbar;
use Livewire\Livewire;
use Tests\TestCase;

class NavbarTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Navbar::class)
            ->assertStatus(200);
    }

    public function test_calcul_Kcal_per_day()
    {
        Livewire::test(Navbar::class)
            ->assertHasNoErrors();
    }
}
