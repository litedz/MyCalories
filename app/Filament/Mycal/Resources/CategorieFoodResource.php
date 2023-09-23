<?php

namespace App\Filament\Mycal\Resources;

use App\Filament\Mycal\Resources\CategorieFoodResource\Pages;
use App\Models\categorie_food;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\File;

class CategorieFoodResource extends Resource
{
    protected static ?string $model = categorie_food::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                FileUpload::make('image')->imageEditor(true)->required()->rules(['image', 'mimes:png,jpg']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                ImageColumn::make('image'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                \Filament\Tables\Actions\Action::make('create')
                    ->label('Create Categorie')
                    ->url('categorie-foods/create')
                    ->icon('heroicon-m-plus')
                    ->button(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategorieFood::route('/'),
            'create' => Pages\CreateCategorieFood::route('/create'),
            'edit' => Pages\EditCategorieFood::route('/{record}/edit'),
        ];
    }
}
