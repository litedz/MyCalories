<?php

namespace Tests\Feature\Livewire;

use App\Livewire\FormCalcul;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FormCalculTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(FormCalcul::class)
            ->assertStatus(200);
    }
}
