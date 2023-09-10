<?php

namespace App\Livewire;

use App\Models\profile;
use App\Models\user_list;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $kcalDay = 0;
    public $bg_limite = 'bg-gray-500';
    public $limite;

    public function mount()
    {
        $this->CalculKcalDay();
    }

    #[On('calcul-kcal-day')]
    public function CalculKcalDay()
    {

        $this->kcalDay = 0;
        $getKcalByday = user_list::whereDate('created_at', Carbon::today()->toDateTimeString())->get();
        $getLimitKcal = profile::select('bmr')->where('id', auth()->user()->id)->first();
        foreach ($getKcalByday as $key => $value) {
            $this->kcalDay = $this->kcalDay + $value->kcal;
        }
        $this->limite = round(($this->kcalDay * 100) / $getLimitKcal->bmr);

        if ($this->limite < 50) {
            $this->bg_limite = 'bg-green-600';
        } else if ($this->limite > 50 && $this->limite < 80) {
            $this->bg_limite = 'bg-yellow-300';
        } else if ($this->limite >= 80 && $this->limite <= 90) {
            $this->bg_limite = 'bg-yellow-500';
        } else if ($this->limite > 90 && $this->limite <= 100) {
            $this->bg_limite = 'bg-red-500';
        } else if ($this->limite > 100) {
            $this->bg_limite = 'bg-red-700';
        }


        // $this->bg_limite = match (true) {
        //     $this->limite <= 50 => 'bg-green-300',
        //     $this->limite < 80 => 'bg-yellow-400',
        //     $this->limite > 100 => 'bg-red-800',
        // };
    }
    public function render()
    {
        return view('livewire.navbar');
    }
}
