<?php

namespace App\Livewire;

use App\Models\favorite as ModelsFavorite;
use App\Models\food;
use App\Models\user_list;
use App\Traits\SweatAlert;
use Livewire\Component;

class Favorite extends Component
{
    use SweatAlert;

    public $favorite;

    public $editQuantity;

    public $editFood_id;

    public $editKcal = 0;

    public $editName = 'Name food';

    protected $rules = [
        'editQuantity' => 'required|integer',
        'editFood_id' => 'required|integer',
    ];

    public function mount()
    {
        $this->getFavorites();
    }

    public function getFavorites()
    {
        $this->favorite = ModelsFavorite::where('user_id', auth()->user()->id)->get();
    }

    public function updatededitQuantity()
    {
        $this->validate();
        $food = food::find($this->editFood_id);
        $this->editKcal = intval(($this->editQuantity * $food->kcal) / $food->quantity);
    }

    public function AddFoodToList($id)
    {

        $this->authorize('create', 'App\Models\user_list');

        $food = food::findOrfail($id);
        $addToList = user_list::create([
            'user_id' => auth()->user()->id,
            'food_id' => $id,
            'kcal' => $food->kcal,
        ]);

        if ($addToList) {
            $this->dispatch('calcul-kcal-day')->component('navbar');
            $this->SweatAlert('Item Add to the list', 'success');
        }
    }

    public function EditFavoriteAndAddToList()
    {
        $this->authorize('create', 'App\Models\user_list');

        $this->validate();

        $food = food::find($this->editFood_id);
        $addToList = user_list::create([
            'user_id' => auth()->user()->id,
            'food_id' => $this->editFood_id,
            'kcal' => $this->editKcal,
        ]);
        if ($addToList) {
            $this->dispatch('calcul-kcal-day')->component('navbar');
            $this->SweatAlert('Item Add to the list', 'success');
        }
    }

    public function RemoveFoodFromFav($id)
    {
        $DeleteFood = ModelsFavorite::where('food_id', $id)->where('user_id', auth()->user()->id)->delete();
        $DeleteFood ? $this->SweatAlert('food removed', 'info') : '';
        $this->getFavorites();
    }

    public function RemoveAllFav(array $list)
    {

        $this->dispatch('Favs-removed');
        $DeleteFood = ModelsFavorite::where('user_id', auth()->user()->id)->whereIn('id', $list)->delete();
        $DeleteFood ? $this->dispatch('Favs-removed') : '';
        $DeleteFood ? $this->SweatAlert('favorites removed', 'info') : '';

        $this->getFavorites();
    }

    public function render()
    {
        return view('livewire.favorite');
    }
}
