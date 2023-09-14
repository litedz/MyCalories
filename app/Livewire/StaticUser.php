<?php

namespace App\Livewire;

use App\Charts\SimpleChar;
use App\Models\user_list;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Livewire\Component;

class StaticUser extends Component
{
    public array $days = [''];
    public array $months = [''];
    public $dataBymonths;
    public $dataBydays;
    public array $kcals = [''];

    public  function mount()
    {
        $this->authorize('view','App\Models\User');
        $this->dataBydays = collect(user_list::with('food')
            ->where('user_id', auth()->user()->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->get())
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('d');
            })->sortBy('created_at', null, false);

        $this->dataBymonths = collect(user_list::with('food')
            ->where('user_id', auth()->user()->id)
            ->get())
            ->groupBy(function ($val) {
                return Carbon::parse($val->created_at)->format('m');
            })->sortByDesc('created_at');


        // Calcul Total kcal  per  month

        foreach ($this->dataBymonths as $key => $value) {
            $totalKcal = 0;
            foreach ($value as $k => $itemInList) {
                $totalKcal += $itemInList['kcal'];
            }
            // Add to A Collection
            $this->dataBymonths[$key]['TotalKcal'] = $totalKcal;
        }
        // Calcul Total kcal  per  days
        foreach ($this->dataBydays as $key => $value) {
            $totalKcal = 0;
            foreach ($value as $k => $itemInList) {
                $totalKcal += $itemInList['kcal'];
            }
            // Add to A Collection
            $this->dataBydays[$key]['TotalKcal'] = $totalKcal;
        }
    }
    public function render()
    {

        foreach ($this->dataBymonths as $key => $value) {
            array_push($this->months, date_create($value->first()->created_at)->format('M'));
            array_push($this->kcals, $value['TotalKcal']);
        }
        foreach ($this->dataBydays as $key => $value) {
            array_push($this->days, date_create($value->first()->created_at)->format('d l'));
           
            array_push($this->kcals, $value['TotalKcal']);
        }
        rsort($this->months);
        // chart daily
        $chart = new SimpleChar;
        $chart->width(500);
        $chart->height(500);
        $chart->labels($this->days);
        $chart->dataset('Calories days', 'line', $this->kcals)->color('blue');
        $chart->title('Calories daily',22,"#1f2937","bold");
        
        // chart monthly
        $chart2 = new SimpleChar;
        $chart2->options(['color' => '#ff0000','backgroundColor' => '#ff0000']);
        $chart2->dataset('', 'line', $this->kcals)->color('green');
        $chart2->width(500);
        $chart2->height(500);
        $chart2->title('Calories Months',22,"#1f2937","bold");
        $chart2->labels($this->months);
       
        return view('livewire.static-user', [
            'chart' => $chart,
            'chart2' => $chart2,
        ]);
    }
}
