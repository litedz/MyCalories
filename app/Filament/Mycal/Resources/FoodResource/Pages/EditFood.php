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
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
