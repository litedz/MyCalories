<?php

namespace App\Livewire;

use App\Models\favorite;
use App\Models\food;
use App\Models\user_list;
use App\Traits\SweatAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Component;

class Foods extends Component
{
    use AuthorizesRequests, SweatAlert;

    public $food;

    public $user_list;

    public $foods;

    public $categorie_food_id;

    public array $favorites_id = [];

    public $editName = 'Name food';

    public $editQuantity;

    public $editFood_id;

    public $editKcal = 0;

    protected $rules = [
        'editQuantity' => 'required|integer',
        'editFood_id' => 'required|integer',
    ];

    public function mount($id)
    {

        $this->categorie_food_id = $id;
        $this->getFoodAandFav();
    }

    public function booted()
    {
        $this->getFoodAandFav();
    }

    public function getFoodAandFav()
    {
        $foods = food::where('categorie_food_id', $this->categorie_food_id)->get();

        if (Auth::check()) {
            $favorite_user = favorite::select('food_id')->where('user_id', auth()->user()->id)->get();
            foreach ($favorite_user as $key => $value) {
                array_push($this->favorites_id, $value->food_id);
            }
        }
        $foods->count() > 0 ? $this->foods = $foods : abort(404);
    }

    public function SortBycategorie($id)
    {
        // $this->foods = food::where('categorie_food_id', $id)->get();
    }

    public function updatededitQuantity()
    {
        $this->validate();
        $food = food::find($this->editFood_id);
        $this->editKcal = intval(($this->editQuantity * $food->kcal) / $food->quantity);
    }

    #[On('Add-to-list')]
    public function AddFoodToList($id)
    {

        if (Gate::denies('create', 'App\\Models\user_list')) {
            $this->SweatAlert('Your must login to access to this action', 'warning');

            return false;
        }

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

    public function AddToFavorite($id)
    {

        $checkFood = favorite::where('food_id', $id)->where('user_id', auth()->user()->id)->first();
        if (! is_null($checkFood)) {
            $this->SweatAlert('this food exist in the favorite list', 'warning');

            return false;
        }
        $addToFav = favorite::create([
            'user_id' => auth()->user()->id,
            'food_id' => $id,
        ]);

        $this->getFoodAandFav();
        $addToFav ? $this->SweatAlert('Add to Favorite', 'Success') : '';
    }

    public function EditAndAddToList()
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

    public function render()
    {

        return view('livewire.foods');
    }
}
