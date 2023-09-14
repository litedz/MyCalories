<?php

use App\Livewire\StaticUser;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(StaticUser::class)
        ->assertStatus(200);
});
