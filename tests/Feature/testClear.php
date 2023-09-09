<?php

use App\Models\User;
use Livewire\Livewire;

test('example', function () {
    $this->actingAs(User::factory()->create());
    Livewire::test(FormCalcul::class)
        ->set('weight', 110)
        ->set('height', 170)
        ->set('unitWeight', 'kg')
        ->set('unitHeight', 'cm')
        ->set('sex', 'men')
        ->set('age', 28)
        ->set('activity', 1.5)
        ->set('BMI', 39)
        ->set('BMR', 4500)
        ->call('SaveProfile')
        ->assertStatus(200);
});
