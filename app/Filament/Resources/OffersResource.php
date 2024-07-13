<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OffersResource\Pages;
use App\Filament\Resources\OffersResource\RelationManagers;
use App\Models\Cities;
use App\Models\Contracts;
use App\Models\Countries;
use App\Models\Currency;
use App\Models\Customers;
use App\Models\Language;
use App\Models\Offers;
use App\Models\Position;
use App\Models\Sectors;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use HusamTariq\FilamentDatabaseSchedule\Filament\Columns\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;
use PHPUnit\Framework\Constraint\Count;

class OffersResource extends Resource
{
    protected static ?string $model = Offers::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\TextColumn::make('client_id')
                    ->label('Client')
                    ->formatStateUsing(fn($state) => Customers::find($state)->company_name),
                Tables\Columns\TextColumn::make('salary')
                    ->numeric()
                    ->prefix(fn($record)=>Currency::find($record->currency)?->sign),
                Tables\Columns\TextColumn::make('country_id')
                    ->label('Location')
                    ->formatStateUsing(function($record){
                        $country = Countries::find($record->country_id)?->name;
                        $city = Cities::find($record->city_id)?->name;

                        return $country . ', ' . $city;
                    }),
                Tables\Columns\TextColumn::make('cost_of_accommodation')
                    ->numeric()
                    ->alignCenter()
                    ->prefix(fn($record)=>Currency::find($record->currency)?->sign),
                Tables\Columns\TextColumn::make('cost_of_insurance')
                    ->numeric()
                    ->alignCenter()
                    ->prefix(fn($record)=>Currency::find($record->currency)?->sign),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->slideOver()
                        ->modalWidth('xl'),
                    Tables\Actions\DeleteAction::make()
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListOffers::route('/'),
//            'create' => Pages\CreateOffers::route('/create'),
//            'edit' => Pages\EditOffers::route('/{record}/edit'),
        ];
    }

    public static function getFormSchema(): array
    {
        return [
            TextInput::make('title')
                ->label(__('admin_offer.title')),
            TextInput::make('salary')
                ->label(__('admin_offer.salary')),
            TextInput::make('cost_of_accommodation')
                ->label(__('admin_offer.cost_of_accommodation')),
            TextInput::make('cost_of_insurance')
                ->label(__('admin_offer.cost_of_insurance')),
            TextInput::make('cost_of_transport')
                ->label(__('admin_offer.cost_of_transport')),
            Select::make('currency')
                ->label(__('admin_offer.currency'))
                ->options(function () {
                    return Currency::all()->mapWithKeys(function ($currency) {
                        return [$currency->id => $currency->sign . ' - ' . $currency->name];
                    });
                }),
            ToggleButtons::make('brutto_netto')
                ->options([
                    'Brutto' => 'Brutto',
                    'Netto' => 'Netto'
                ])
                ->inline()
                ->grouped(),
            ToggleButtons::make('payout_system')
                ->label(__('admin_offer.payout_system'))
                ->options([
                    "weekly" => __('admin_offer.weekly'),
                    "monthly" => __('admin_offer.monthly'),
                ])
                ->inline()
                ->grouped(),
            Select::make('client_id')
                ->label(__('admin_offer.client'))
                ->options(Customers::all()->pluck('company_name','id')),
            Select::make('sector_id')
                ->label(__('admin_offer.sector'))
                ->options(Sectors::all()->pluck('name','id')),
            Select::make('country_id')
                ->label(__('admin_offer.country'))
                ->required()
                ->options(Countries::all()->pluck('name','id'))
                ->reactive()
                ->afterStateUpdated(function ($set, $state) {
                    $set('city_id', null);
                }),
            Select::make('city_id')
                ->label(__('admin_offer.city'))
                ->required()
                ->options(function (callable $get) {
                    $countryId = $get('country_id');
                    if ($countryId) {
                        return Cities::where('country_id', $countryId)->orderBy('name')->pluck('name', 'id');
                    }
                    return Cities::query()->orderBy('name')->pluck('name', 'id');
                })
                ->reactive()
                ->afterStateUpdated(function ($set, $get, $state) {
                    if ($state) {
                        $city = Cities::find($state);
                        if ($city) {
                            $set('country_id', $city->country_id);
                        }
                    }
                }),
            Select::make('position_id')
                ->label(__('admin_offer.position'))
                ->options(Position::all()->pluck('name','id')),
            Select::make('contract_id')
                ->label(__('admin_offer.contract'))
                ->options(Contracts::all()->pluck('name','id')),
            Select::make('language_id')
                ->label(__('admin_offer.language'))
                ->options(Language::all()->pluck('name','id')),
            ToggleButtons::make('age_rate')
                ->label(__('admin_offer.age_rate'))
                ->options([
                    1 => __('admin_offer.yes'),
                    0 => __('admin_offer.no')
                ])
                ->colors([
                    1 => 'success',
                    0 => 'danger'
                ])
                ->default(0)
                ->inline()
                ->grouped(),
            ToggleButtons::make('without_language')
                ->label(__('admin_offer.without_language'))
                ->options([
                    1 => __('admin_offer.yes'),
                    0 => __('admin_offer.no')
                ])
                ->colors([
                    1 => 'success',
                    0 => 'danger'
                ])
                ->default(0)
                ->inline()
                ->grouped(),
            ToggleButtons::make('is_top_offer')
                ->label(__('admin_offer.is_top_offer'))
                ->options([
                    1 => __('admin_offer.yes'),
                    0 => __('admin_offer.no')
                ])
                ->colors([
                    1 => 'success',
                    0 => 'danger'
                ])
                ->default(0)
                ->inline()
                ->grouped(),
            TinyEditor::make('job_description')
                ->label(__('admin_offer.job_description'))
                ->minHeight(300),
            TinyEditor::make('we_offer')
                ->label(__('admin_offer.we_offer'))
                ->minHeight(300),
            TinyEditor::make('requirements')
                ->label(__('admin_offer.requirements'))
                ->minHeight(300),
            ToggleButtons::make('is_active')
                ->label(__('admin_offer.is_active'))
                ->options([
                    1 => __('admin_offer.active'),
                    0 => __('admin_offer.inactive')
                ])
                ->colors([
                    1 => 'success',
                    0 => 'danger'
                ])
                ->default(1)
                ->inline()
                ->grouped(),
            Placeholder::make('long_lat')
                ->label('Long,Lat')
                ->content(fn($record) => $record?->longitude . ',' . $record?->latitude)
                ->visible(fn($record)=> $record?->longitude ? 1: 0)
        ];
    }

    public static function getTableSchema(): array
    {
        return [
            Tables\Columns\TextColumn::make('title')
                ->label(__('admin_offer.title')),
            Tables\Columns\TextColumn::make('client_id')
                ->label(__('admin_offer.client'))
                ->formatStateUsing(fn($state) => Customers::find($state)->company_name),
            Tables\Columns\TextColumn::make('salary')
                ->label(__('admin_offer.salary'))
                ->numeric(2,'.',',')
                ->prefix(fn($record)=>Currency::find($record->currency)?->sign),
            Tables\Columns\TextColumn::make('country_id')
                ->label(__('admin_offer.address'))
                ->formatStateUsing(function($record){
                    $country = Countries::find($record->country_id)?->name;
                    $city = Cities::find($record->city_id)?->name;

                    return $country . ', ' . $city;
                }),
            Tables\Columns\TextColumn::make('cost_of_accommodation')
                ->label(__('admin_offer.cost_of_accommodation'))
                ->numeric(2,'.',',')
                ->alignCenter()
                ->prefix(fn($record)=>Currency::find($record->currency)?->sign),
            Tables\Columns\TextColumn::make('cost_of_insurance')
                ->label(__('admin_offer.cost_of_insurance'))
                ->numeric(2,'.',',')
                ->alignCenter()
                ->prefix(fn($record)=>Currency::find($record->currency)?->sign),
        ];
    }
}
