<?php

namespace App\Livewire;

use App\Models\food;
use App\Models\user_list;
use Livewire\Component;
use Livewire\Attributes\On;

class Foods extends Component
{

    public $foods;
    public $editName = "Name food";
    public $editQuantity;
    public $editFood_id;
    public $editKcal = 0;

    protected $rules = [
        'editQuantity' => 'required|integer',
        'editFood_id' => 'required|integer',
    ];

    public function mount($id)
    {
        $this->foods = food::where('categorie_food_id', $id)->get();
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
        // $this->foods = food::where('categorie_food_id', $id)->get();
    }
    public function AddFoodToList($id)
    {
        $validatedData = request()->validate([
            'id' => 'integer',
        ]);
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

    public function EditAndAddToList()
    {

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
    public function SweatAlert(string $title, string $type)
    {
        $this->dispatch('testwal', [
            'title' => $title,
            'icon' => $type,
        ]);
    }
    public function render()
    {

        return view('livewire.foods');
    }
}
