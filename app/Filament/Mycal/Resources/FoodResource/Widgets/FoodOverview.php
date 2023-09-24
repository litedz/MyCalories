<?php

namespace App\Filament\Mycal\Resources\FoodResource\Widgets;

use App\Models\favorite;
use App\Models\food;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class FoodOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Foods', food::all()->count())
                ->description('Number Food')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
            Stat::make('Most Add to favorites', $this->MostFoodAddToFavorite())

                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),
        ];
    }

    protected function MostFoodAddToFavorite()
    {
        $favorites= favorite::with('food')->get()->groupBy('food.name')->sortDesc();
        foreach ($favorites as $key => $value) {
          return $key;
        }
    }
}
