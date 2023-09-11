<?php

namespace App\Livewire;

use App\Models\categorie_food;
use App\Models\food;
use Livewire\Component;

class Categories extends Component
{
    public $categories;

    public function mount()
    {
        $this->categories = categorie_food::get();
    }

    public function SortFoodBycategorie($id)
    {
        $this->categories = food::find($id)->get();
    }

    public function SortBycategorie($id)
    {
        $this->categories = food::where('id', $id)->get();
    }

    public function render()
    {
        return view('livewire.categories');
    }
}
