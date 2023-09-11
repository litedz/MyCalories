<?php

namespace App\Livewire;

use App\Models\favorite as ModelsFavorite;
use App\Traits\SweatAlert;
use Livewire\Component;

class Favorite extends Component
{
    use SweatAlert;

    public $favorite;

    public function mount()
    {
        $this->getFavorite();
    }

    public function getFavorite()
    {
        $this->favorite = ModelsFavorite::where('user_id', auth()->user()->id)->get();
    }

    public function RemoveFoodFromFav($id)
    {
        $DeleteFood = ModelsFavorite::where('food_id', $id)->where('user_id', auth()->user()->id)->delete();
        $DeleteFood ? $this->SweatAlert('food removed', 'info') : '';
        $this->getFavorite();
    }

    public function render()
    {
        return view('livewire.favorite');
    }
}
