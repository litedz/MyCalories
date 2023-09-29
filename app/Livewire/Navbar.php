<?php

namespace App\Livewire;

use App\Models\profile;
use App\Models\user_list;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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

        if (Gate::allows('view', 'App\\Models\User')) {

            $this->kcalDay = 0;
            $getKcalByday = user_list::whereDate('created_at', Carbon::today()->toDateTimeString())->where('user_id', auth()->user()->id)->get();
            $getLimitKcal = profile::select('bmr')->where('id', auth()->user()->profile_id)->first();
           
            if (!is_null($getLimitKcal)) {
                // Calcul max kcal allowed
                foreach ($getKcalByday as $key => $value) {
                    $this->kcalDay = $this->kcalDay + $value->kcal;
                }
                $this->limite = round(($this->kcalDay * 100) / $getLimitKcal->bmr);
                $this->bg_limite = match (true) {
                    $this->limite < 50 => 'bg-green-600',
                    $this->limite > 50 && $this->limite < 80 => 'bg-yellow-300',
                    $this->limite > 80 && $this->limite < 90 => 'bg-yellow-500',
                    $this->limite > 90 && $this->limite < 100 => 'bg-red-500',
                    $this->limite > 100 => 'bg-red-700',
                    default => 'bg-slate-700',
                };
            }
        }
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('welcome');
    }

    public function render()
    {
        return view('livewire.navbar');
    }
}
