<?php

namespace App\Filament\Mycal\Resources\FoodResource\Pages;

use App\Filament\Mycal\Resources\FoodResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFood extends EditRecord
{
    protected static string $resource = FoodResource::class;

    protected function getHeaderActions(): array
    {
        $this->data['current_cat'] = $this->getRecord()->cat->name;

        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['current_cat'] = $this->getRecord()->cat->name;
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {

        $data = array_merge($data, ['categorie_food_id' => $data['categories']]);
        $data = array_diff_key($data, ['current_cat' => $data['current_cat'], 'categories' => $data['categories']]);
        $this->refreshFormData(['current_cat']);

        return $data;
    }
}
