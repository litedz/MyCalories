<?php

namespace App\Filament\Mycal\Resources\UserResource\Pages;

use App\Filament\Mycal\Resources\UserResource;
use App\Filament\Mycal\Resources\UserResource\Widgets\UsersOverview;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
           UsersOverview::class,
        ];
    }
}
