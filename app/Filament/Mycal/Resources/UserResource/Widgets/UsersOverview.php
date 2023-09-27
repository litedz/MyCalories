<?php

namespace App\Filament\Mycal\Resources\UserResource\Widgets;

use App\Models\profile;
use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UsersOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';

    protected function getStats(): array
    {

        return [
            Stat::make('USERS', User::all()->count())
                ->description('Number Register Users')
                ->descriptionIcon('heroicon-m-user')
                ->chart($this->UserStaticRegister())->color('success'),
            Stat::make('OVERWEIGHT', profile::where('result', 'OVERWEIGHT')->orWhere('result', 'OBESE_1')->orWhere('result', 'OBESE_2')->get()->count())
                ->description('OVERWEIGHT Users')
                ->descriptionIcon('heroicon-m-user')
                ->chart([profile::where('result')])->color('warning'),
            Stat::make('ADULT OVERWEIGHT USERS', profile::whereIn('result', ['OVERWEIGHT', 'OBESE_1', 'OBESE_2'])
                ->where('age', '<', 19)->get()->count())
                ->description('Adult overweight users under 20 years old')
                ->descriptionIcon('heroicon-m-user')
                ->color('info'),

        ];
    }

    protected function UserStaticRegister(): array
    {
        $data = [];
        foreach (User::get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('m');
        }) as $key => $value) {
            array_push($data, $value->count());
        }

        return $data;
    }
}
