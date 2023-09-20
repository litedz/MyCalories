<?php

namespace App\Filament\Mycal\Resources\CategorieFoodResource\Pages;

use App\Filament\Mycal\Resources\CategorieFoodResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategorieFood extends ListRecords
{
    protected static string $resource = CategorieFoodResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
