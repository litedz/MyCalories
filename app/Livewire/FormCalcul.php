<?php

namespace App\Livewire;

use App\Models\profile;
use Livewire\Component;

class FormCalcul extends Component
{
    public $bmi;
    public $weight;
    public $height;
    public $showBtnSave;
    public $sex;
    public $age;
    public $activity;
    public $BMR;
    public $BMI;
    public $ResultShow;
    protected $rules = [
        'bmi' => 'integer',
    ];

    public function SaveProfile()
    {
        $this->validate();
        $profile = profile::where('id', auth()->user()->id)->update();
    }
    public function render()
    {
        return view('livewire.form-calcul');
    }
}
