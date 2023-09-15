<?php

namespace App\Livewire;

use App\Models\food;
use App\Models\user_list;
use App\Traits\SweatAlert;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ListFoodUser extends Component
{
    use SweatAlert, WithPagination;

    protected $rules = [
        'editQuantity' => 'required|integer',
        'editFood_id' => 'required|integer',
    ];

    public $lists;

    public $editName;

    public $editQuantity;

    public $editFood_id;

    public $list_id;

    public $editKcal;
    public $loadmore = true;

    public int $loadeMoreNum = 1;

    public function mount()
    {
        $this->getLists();
    }

    public function dehydrate()
    {
    }

    public function UpdateList()
    {
    }
    public function updatedLoadeMoreNum()
    {
        $this->getLists();
    }

    public function updatededitQuantity()
    {
        $this->validate();
        $food = food::find($this->editFood_id);
        $this->editKcal = intval(($this->editQuantity * $food->kcal) / $food->quantity);
    }

    public function EditAndUpdateList()
    {
        $this->validate();
        $food = food::find($this->editFood_id);

        $updateFood = user_list::find($this->list_id);
        $updateFood->kcal = $this->editKcal;
        $Updated = $updateFood->save();

        if ($Updated) {
            $this->dispatch('calcul-kcal-day')->component('navbar');
            $this->getLists();
            $this->SweatAlert('Item Updated', 'info');
        }
    }

    public function DeleteFood($food_id, $list_id)
    {

        $DeleteFood = user_list::where('user_id', auth()->user()->id)->where('food_id', $food_id)->where('id', $list_id)->delete();
        if ($DeleteFood) {
            $this->dispatch('calcul-kcal-day')->component('navbar');
            $this->SweatAlert('Food Deleted', 'success');
            $this->getLists();
        }
    }


    public function getLists()
    {
        // if ($this->loadmore) {
        //     $this->lists = collect(user_list::with('food')
        //         ->where('user_id', auth()->user()->id)
        //         ->where('id', '>', $this->LastItemId)
        //         ->limit(5)
        //         ->get())
        //         ->groupBy(function ($val) {
        //             return Carbon::parse($val->created_at)->format('m d');
        //         })
        //         ->sortBy('created_at')
        //         ->values();
        // }
        $this->lists = collect(user_list::with('food')->where('user_id', auth()->user()->id)->limit($this->loadeMoreNum)->get())->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('m d');
        })->sortBy('created_at')->values();


        if ($this->lists->count() < $this->loadeMoreNum) {
            $this->loadmore = false;
        }
        // Calcul Total kcal  per day or month


        foreach ($this->lists as $key => $value) {
            $totalKcal = 0;
            foreach ($value as $k => $itemInList) {
                $totalKcal += $itemInList['kcal'];
            }
            // Add to A Collection
            $this->lists[$key]['TotalKcal'] = $totalKcal;
        }
    }


    public function render()
    {
        return view('livewire.list-food-user');
    }
}
