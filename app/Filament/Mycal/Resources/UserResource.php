<?php

namespace App\Filament\Mycal\Resources;

use App\Events\ContactUserEvent;
use App\Filament\Mycal\Resources\UserResource\Pages;
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

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

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
                        MarkdownEditor::make('Message'),

                    ])
                    ->action(function (array $data) {
                        ContactUserEvent::dispatch($data['email'],$data['name'],$data['subject']);
                    })
                    ->link(),
                Tables\Actions\EditAction::make()->action(fn (array $data) => dd($data)),
                ViewAction::make()
                    ->form([
                        TextInput::make('name'),
                        TextInput::make('profile.result'),
                    ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make('edits'),
                ]),
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
