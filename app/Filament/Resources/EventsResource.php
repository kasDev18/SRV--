<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventsResource\Pages;
use App\Filament\Resources\EventsResource\RelationManagers;
use App\Models\Event;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use HusamTariq\FilamentDatabaseSchedule\Filament\Columns\ActionGroup;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Tables\Columns\TextColumn;

class EventsResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getPluralLabel(): ?string
    {
        return __('admin_settings.events');
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('admin_events.name'))
                    ->required()
                    ->maxLength(255),
                DatePicker::make('starts_at')
                    ->label(__('admin_events.starts_at')),
                DatePicker::make('ends_at')
                    ->label(__('admin_events.ends_at')),
                Checkbox::make('allDay')
                    ->label(__('admin_events.all_day'))
                    ->inline()
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('admin_events.name'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('starts_at')
                    ->label(__('admin_events.starts_at'))
                    ->date('m/d/Y'),
                TextColumn::make('ends_at')
                    ->label(__('admin_events.ends_at'))
                    ->date('m/d/Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->slideOver()
                        ->modalWidth('md'),
                    Tables\Actions\DeleteAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // TODO : ADD Something here
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
//            'create' => Pages\CreateEvents::route('/create'),
//            'edit' => Pages\EditEvents::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('admin_settings.events');
    }


}
