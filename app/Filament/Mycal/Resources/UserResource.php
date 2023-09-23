<?php

namespace App\Filament\Mycal\Resources;

use App\Events\ContactUserEvent;
use App\Filament\Mycal\Resources\UserResource\Pages;
use App\Filament\Mycal\Resources\UserResource\Widgets\UserssOverview;
use App\Jobs\ProcessContactUsers;
use App\Models\profile;
use App\Models\User;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\ListRecords\Tab;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public $CustomeMessage;

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('profile.result')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('Contact')

                    ->fillForm(fn (User $record): array => [
                        'name' => $record->name,
                        'email' => $record->email,

                    ])
                    ->form([
                        TextInput::make('name')->readOnly(true),
                        TextInput::make('email')->readOnly(),
                        TextInput::make('subject'),
                        MarkdownEditor::make('message'),

                    ])

                    ->action(function (array $data) {
                        ContactUserEvent::dispatch($data['email'], $data['name'], $data['subject']);
                    })
                    ->link(),
                Tables\Actions\EditAction::make(),
                ViewAction::make()
                    ->mutateRecordDataUsing(function (array $data): array {
                        $profile = profile::where('id', $data['profile_id'])->first();
                        $data['result'] = $profile->result;
                        $data['age'] = $profile->age;
                        $data['sex'] = $profile->sex;
                        $data['weight'] = $profile->weight;
                        $data['unitWeight'] = $profile->unitWeight;
                        $data['height'] = $profile->height;
                        $data['unitHeight'] = $profile->unitHeight;
                        $data['activity'] = $profile->activity;
                        $data['result'] = $profile->result;

                        return $data;
                    })
                    ->form([
                        TextInput::make('name')->columnSpan(2),
                        TextInput::make('age')->columnSpan(2),
                        TextInput::make('sex')->columnSpan(2),
                        TextInput::make('weight'),
                        TextInput::make('unitWeight'),
                        TextInput::make('height'),
                        TextInput::make('unitHeight'),
                        TextInput::make('activity'),
                        TextInput::make('result'),
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
                Tables\Actions\BulkAction::make('Contact all')
                    ->form([
                        TextInput::make('subject'),
                        MarkdownEditor::make('message'),
                    ])
                    ->button()
                    ->color('primary')
                    ->icon('heroicon-o-envelope')
                    ->action(
                        function (Collection $records, array $data) {
                            $records->each(function ($user) use ($data) {
                                ProcessContactUsers::dispatchSync($user->email, $user->name, $data['subject'], $data['message']);
                            });
                        }
                    ),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'active' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('is_admin', true)),
            'inactive' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('active', false)),
        ];
    }

}
