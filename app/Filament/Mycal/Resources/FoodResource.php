<?php

namespace App\Filament\Mycal\Resources;

use App\Filament\Mycal\Resources\FoodResource\Pages;
use App\Models\categorie_food;
use App\Models\Food;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FoodResource extends Resource
{
    protected static ?string $model = Food::class;

    protected static ?string $navigationIcon = 'heroicon-o-list-bullet';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('code')->nullable(),
                TextInput::make('protien')->required(),
                Select::make('cat')->label('categories')
                    ->relationship('cat', titleAttribute: 'name')->required(),
                TextInput::make('carbohydrate')->required(),
                TextInput::make('kcal')->required(),
                TextInput::make('quantity')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('code'),
                TextColumn::make('protien'),
                TextColumn::make('carbohydrate'),
                TextColumn::make('kcal'),
                TextColumn::make('quantity'),
                TextColumn::make('cat.name')->label('categorie')->badge()->color('info'),
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
                    ->label('Create Food')
                    ->url('food/create')
                    ->icon('heroicon-m-plus')
                    ->button(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFood::route('/'),
            'create' => Pages\CreateFood::route('/create'),
            'edit' => Pages\EditFood::route('/{record}/edit'),
        ];
    }
}
