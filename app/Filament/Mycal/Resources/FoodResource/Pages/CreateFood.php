<?php

namespace App\Filament\Mycal\Resources\FoodResource\Pages;

use App\Filament\Mycal\Resources\FoodResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFood extends CreateRecord
{
    protected static string $resource = FoodResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //remove field current categorie from the form 
        $data = array_merge($data, ['categorie_food_id' => $data['cat']]);
        $data = array_diff_key($data, ['cat' => $data['cat']]);
        return $data;
    }

    protected function afterFill(): void
    {
        //remove field current categorie from the form 
        // $this->data = array_diff_key($this->data, ['current_cat' => null]);
    }
}
