<?php

namespace App\Livewire;

use App\Models\user_list;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $kcalDay;

    public function mount()  {
        $this->CalculKcalDay();
    }

    #[On('calcul-kcal-day')]
    public function CalculKcalDay()
    {
        
        $this->kcalDay = 0;
        $getKcalByday = user_list::whereDate('created_at', Carbon::today()->toDateTimeString())->get();
        foreach ($getKcalByday as $key => $value) {
            $this->kcalDay = $this->kcalDay + $value->kcal;
        }
    }
    public function render()
    {
        return view('livewire.navbar');
    }
}
