<?php

namespace App\Filament\Mycal\Resources\UserResource\Pages;

use App\Filament\Mycal\Resources\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
