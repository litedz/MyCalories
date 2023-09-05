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
    public function test_form_require_attribute()
    {
        Livewire::test(FormCalcul::class)
            ->call('SaveProfile')
            ->assertHasErrors('bmi');
    }
    public function test_Calcul_bmi_and_bmr()
    {
        Livewire::test(FormCalcul::class)
            ->call('SaveProfile')
            ->assertHasErrors('bmi');
    }
}
