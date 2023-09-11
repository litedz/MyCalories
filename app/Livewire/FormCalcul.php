<?php

namespace App\Livewire;

use App\Models\profile;
use App\Models\User;
use App\Traits\SweatAlert;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FormCalcul extends Component
{
    use SweatAlert;

    public $weight = '';

    public $height = '';

    public $unitWeight = 'kg';

    public $unitHeight = 'cm';

    public $sex = 'men';

    public $age = '';

    public $activity = '';

    public $bmr;

    public $bmi;

    public $result = '';

    public $ResultShow = false;

    public $indiceBar = 0;

    protected $rules = [
        'weight' => 'required|numeric|min:20|max:500',
        'height' => 'required|numeric|min:20|max:500',
        'unitWeight' => 'required',
        'unitHeight' => 'required',
        'sex' => 'required|max:6',
        'age' => 'required|integer|max:200',
        'activity' => 'required|string',

    ];

    public function Calculbmi(): void
    {
        $this->validate();
        $this->ConvertUnit();
        $this->bmi = round($this->weight / (($this->height / 100) * ($this->height / 100)), 1);
        $this->Calculbmr();
    }

    public function Calculbmr(): void
    {

        if ($this->sex == 'woman') {
            $this->bmr = round((444.593 + 9.247 * $this->weight + 3.098 * $this->height - 4.33 * abs($this->age)) * $this->activity);
        } else {
            $this->bmr = round((88.362 + 13.397 * $this->weight + 4.799 * $this->height - 5.677 * abs($this->age)) * $this->activity);
        }

        $this->bmi >= 40 ? $this->indiceBar = 100 : $this->indiceBar = ($this->bmi * 100) / 40;
        // result of bmi
        $this->result = match (true) {
            $this->bmi < 18.5 => 'UNDERWEIGHT',
            $this->bmi > 18.5 && $this->bmi < 24.9 => 'NORMAL',
            $this->bmi > 25 && $this->bmi < 29.9 => 'Overweight',
            $this->bmi > 30 && $this->bmi < 34.9 => 'OBESE_2',
            $this->bmi > 35 => 'OBESE_1',
        };
        $this->ResultShow = true;
    }

    public function ConvertUnit(): void
    {
        if ($this->unitWeight == 'pound') {
            $this->weight = $this->weight * 2.20;
        }
        if ($this->unitHeight == 'inch') {
            $this->height = $this->height * 0.39;
        }
    }

    public function SaveProfile()
    {

        
        if (Gate::denies('create','App\\Models\User')) {
          $this->SweatAlert('You most login to save profile','warning');
          return false;
        }
       
        // $this->authorize('create', User::class);


        $validData = $this->validate();
        $val = Validator::make(
            ['bmi' => $this->bmi, 'bmr' => $this->bmr],
            ['bmi' => 'required', 'bmr' => 'required|numeric'],
            ['required' => 'The :attribute field is required'],
        )->validate();

        //activitys .
        $activ = match (true) {
            $this->activity == 1.2 => 'SLOW',
            $this->activity == 1.375 => 'NORMAL',
            $this->activity == 1.55 => 'INTERMEDIATE',
            $this->activity == 1.725 => 'HIGH',
            $this->activity == 1.9 => 'SUPER',
            default => throw new NotFoundHttpException('Invalid activity')
        };

        $allData = array_merge($val, $validData, ['result' => $this->result, 'activity' => $activ]);

        try {
            if (is_null(auth()->user()->profile_id)) {

                $profile = profile::create($allData);

                $UpdateIdProfile = User::where('id', auth()->user()->id)->updateOrCreate(['profile_id' => null], ['profile_id' => $profile->id]);

                $this->SweatAlert('Profile Created', 'success');
            } else {
                $profile = profile::where('id', auth()->user()->id)->update($allData);

                $this->SweatAlert('Profile Updated', 'success');
            }
        } catch (\Throwable $th) {
            throw $th;
        }

        $this->reset();
    }

    public function render()
    {
        return view('livewire.form-calcul');
    }
}
