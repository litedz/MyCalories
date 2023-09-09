<?php

namespace Tests\Feature\Livewire;

use App\Livewire\FormCalcul;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
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
    public function test_require_attributes()
    {
        Livewire::test(FormCalcul::class)
            ->set('weight', '')
            ->set('height', '')
            ->set('unitWeight', '')
            ->set('unitHeight', '')
            ->set('sex', '')
            ->set('age', '')
            ->set('activity', '')
            ->call('Calculbmi')
            ->assertHasErrors(['weight', 'height', 'unitWeight', 'unitHeight', 'sex', 'age', 'activity']);
    }
    public function test_user_can_calcul_bmi_and_bmr()
    {
        Livewire::test(FormCalcul::class)
            ->set('weight', 110)
            ->set('height', 170)
            ->set('unitWeight', 'kg')
            ->set('unitHeight', 'cm')
            ->set('sex', 'men')
            ->set('age', 28)
            ->set('activity', 1.5)
            ->call('Calculbmi')
            ->assertStatus(200);
    }
    public function test_require_result_for_save_profile()
    {
        $this->actingAs(User::factory()->create());


        Livewire::test(FormCalcul::class)
            ->set('bmi', '')
            ->set('bmr', '')
            ->call('SaveProfile')
            ->assertHasErrors();
    }
    public function test_save_profile()
    {

        $this->actingAs(User::factory()->create());

        Livewire::test(FormCalcul::class)
            ->set('weight', 110)
            ->set('height', 170)
            ->set('unitWeight', 'kg')
            ->set('unitHeight', 'cm')
            ->set('sex', 'men')
            ->set('age', 28)
            ->set('activity', "1.5")
            ->set('bmi', 39)
            ->set('bmr', 4500)
            ->set('result', "obese")
            ->call('SaveProfile')
            ->assertHasNoErrors();
    }
    public function test_convert_unit_pound_and_inch()
    {

        $this->actingAs(User::factory()->create());

        Livewire::test(FormCalcul::class)
            ->set('weight', 110)
            ->set('height', 170)
            ->set('unitWeight', 'pound')
            ->set('unitHeight', 'inch')
            ->call('ConvertUnit')
            ->assertHasNoErrors();
    }
}
