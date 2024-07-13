<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomersResource\Pages;
use App\Filament\Resources\CustomersResource\RelationManagers;
use App\Models\Countries;
use App\Models\Currency;
use App\Models\Customers;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use HusamTariq\FilamentDatabaseSchedule\Filament\Columns\ActionGroup;
use App\Helpers\FileHelper;

class ActiveCustomersResource extends Resource
{
    protected static ?string $model = Customers::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?string $navigationGroup = 'Customers';

    protected static ?string $navigationLabel = 'Active';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultPaginationPageOption(50)
            ->columns(self::getTableSchema())
            ->filters([

            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make()
                        ->slideOver()
                        ->form(ActiveCustomersResource::getFormSchema())
                        ->modalWidth('md')
                        ->tooltip('Edit'),
                ])
            ])
            ->defaultSort('company_name', 'asc')
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }

    public static function getTableSchema(): array
    {
        return [
            TextColumn::make('company_name')
                ->label(__('admin_customer.company_name'))
                ->sortable()
                ->searchable(),
            TextColumn::make('phone_number')
                ->label(__('admin_customer.phone_number'))
                ->searchable()
                ->sortable(),
            TextColumn::make('email')
                ->label(__('admin_customer.email'))
                ->searchable()
                ->sortable(),
            TextColumn::make('tax_number')
                ->label(__('admin_customer.tax_number'))
                ->sortable()
                ->searchable(),
        ];
    }

    public static function getFormSchema(): array
    {
        return [
            TextInput::make('company_name')
                ->label(__('admin_customer.company_name'))
                ->required()
                ->maxLength(255),
            TextInput::make('phone_number')
                ->label(__('admin_customer.phone_number'))
                ->required()
                ->maxLength(14),
            TextInput::make('tax_number')
                ->label(__('admin_customer.tax_number'))
                ->required()
                ->maxLength(20),
            TextInput::make('address')
                ->label(__('admin_customer.address'))
                ->required()
                ->maxLength(255),
            Select::make('country_id')
                ->label(__('admin_customer.country'))
                ->required()
                ->options(Countries::all()->pluck('name','id')),
            TextInput::make('date_of_payment')
                ->label(__('admin_customer.date_of_payment'))
                ->numeric()
                ->maxValue(31)
                ->minValue(1)
                ->required(),
            Select::make('currency_id')
                ->label(__('admin_customer.currency'))
                ->required()
                ->options(function () {
                    return Currency::all()->mapWithKeys(function ($currency) {
                        return [$currency->id => $currency->sign . ' - ' . $currency->name];
                    });
                }),
            TextInput::make('email')
                ->label(__('admin_customer.email'))
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\ToggleButtons::make('status')
                ->label(__('admin_offer.is_active'))
                ->grouped()
                ->default(1)
                ->options([
                    '1' => __('admin_offer.active'),
                    '0' => __('admin_offer.inactive'),
                ])
                ->colors(FileHelper::boolean_colors()),
            Forms\Components\Hidden::make('country')
                ->default('1'),
            Forms\Components\Hidden::make('currency')
                ->default('1')
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActiveCustomers::route('/'),
//            'create' => Pages\CreateCustomers::route('/create'),
//            'edit' => Pages\EditCustomers::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('admin_settings.active_customers');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin_settings.customers');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin_settings.customers'); // TODO: Change the autogenerated stub
    }
}
