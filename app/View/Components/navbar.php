<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Livewire\Attributes\On;

class navbar extends Component
{
    public $test = 'xxx';

    #[On('kcal-test')]
    public function ccccc()
    {

        dd('xxx');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
