<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdersResource\Pages;
use App\Filament\Resources\OrdersResource\RelationManagers;
use App\Helpers\FileHelper;
use App\Models\Candidate;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Customers;
use App\Models\Orders;
use App\Models\Position;
use Cassandra\Custom;
use Faker\Provider\Text;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use HusamTariq\FilamentDatabaseSchedule\Filament\Columns\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\View;
use function Laravel\Prompts\textarea;

class ActiveOrdersResource extends Resource
{
    protected static ?string $model = Orders::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultPaginationPageOption(50)
            ->columns(self::getTableSchema())
            ->filters([

            ])
            ->defaultSort('created_at','desc')
            ->actions([
                ActionGroup::make([
                    Action::make(__('admin_candidate.view_candidate'))
                        ->tooltip(__('admin_candidate.view_candidate'))
                        ->icon('heroicon-o-eye')
                        ->color('info')
                        ->modalSubmitAction(false)
                        ->modalCancelAction(false)
                        ->modalContent(function ($record) {
                            return View::make('livewire.livewire_wrapper.assigned-candidate-table-wrapper', [
                                'orderId' => [$record->id],
                            ]);
                        })
                        ->modalWidth('5xl'),
                    EditAction::make()
                        ->tooltip(__('admin_candidate.edit'))
                        ->form(self::getFormSchema())
                        ->slideOver()
                        ->modalWidth('md'),
                    Action::make('Finish')
                        ->tooltip(__('admin_order.finish'))
                        ->icon('heroicon-s-check-badge')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalIcon('heroicon-o-shield-check')
                        ->modalHeading(fn($record) => $record->topic)
                        ->modalDescription(__('admin_order.finish_msg'))
                        ->action(fn(Orders $record)=>$record->moveToFinish()),
                    DeleteAction::make()
                        ->tooltip(__('admin_order.delete'))
                        ->requiresConfirmation()
                ])


            ])
            ->bulkActions([

            ]);
    }

    public static function getFormSchema()
    {
        return [
            TextInput::make('topic')
                ->label(__('admin_order.topic'))
                ->required(),
            Select::make('customer_id')
                ->label(__('admin_order.client'))
                ->options(Customers::all()->pluck('company_name','id'))
                ->required(),
            TextInput::make('week_number')
                ->label(__('admin_order.week_number'))
                ->numeric()
                ->maxValue(52)
                ->minValue(1)
                ->required(),
            TextInput::make('year')
                ->label(__('admin_order.year'))
                ->required(),
            Select::make('position_id')
                ->label(__('admin_order.position'))
                ->options(Position::all()->pluck('name','id'))
                ->required(),
            Select::make('country_id')
                ->label(__('admin_order.country'))
                ->required()
                ->options(Countries::all()->pluck('name','id'))
                ->reactive()
                ->afterStateUpdated(function ($set, $state) {
                    $set('city_id', null);
                }),
            Select::make('city_id')
                ->label(__('admin_order.city'))
                ->required()
                ->options(function (callable $get) {
                    $countryId = $get('country_id');
                    if ($countryId) {
                        return Cities::where('country_id', $countryId)->pluck('name', 'id');
                    }
                    return Cities::all()->pluck('name', 'id');
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
            TextInput::make('demand')
                ->label(__('admin_order.demand'))
                ->numeric()
                ->required(),
            Textarea::make('description')
                ->label(__('admin_order.description')),
            Forms\Components\ToggleButtons::make('is_active')
                ->label(__('admin_order.status'))
                ->grouped()
                ->colors(FileHelper::boolean_colors())
                ->default(1)
                ->options([
                    '1' => __('admin_order.is_active'),
                    '0' => __('admin_offer.inactive'),
                ]),
            Hidden::make('candidate_id')
                ->default(0),
            Hidden::make('is_deleted')
                ->default(0)

        ];
    }

    public static function getTableSchema(): array
    {
        return [
            TextColumn::make('topic')
                ->sortable()
                ->label(__('admin_order.topic')),
            TextColumn::make('customer.company_name')
                ->sortable()
                ->label(__('admin_order.client')),
            TextColumn::make('week_number')
                ->sortable()
                ->label(__('admin_order.week_number'))
                ->alignCenter(),
            TextColumn::make('year')
                ->sortable()
                ->label(__('admin_order.year'))
                ->alignCenter(),
            TextColumn::make('demand')
                ->sortable()
                ->label(__('admin_order.demand'))
                ->alignCenter(),
            TextColumn::make('candidates_during_recruitment')
                ->sortable()
                ->label(__('admin_order.num_applied'))
                ->default(0)
                ->formatStateUsing(function ($record){
                    $count = Candidate::where('order_id',$record->id)->count();
                    return $count;
                })
                ->alignCenter(),
            TextColumn::make('accepted_candidates')
                ->sortable()
                ->label(__('admin_order.accepted_candidates'))
                ->alignCenter()
                ->default(0)
                ->formatStateUsing(function ($record){
                    $count = Candidate::where('order_id',$record->id)
                        ->where('is_working',Candidate::STATUS_WORKING)
                        ->count();
                    return $count;
                }),
            TextColumn::make('position.name')
                ->sortable()
                ->label(__('admin_order.position')),
            TextColumn::make('country_id')
                ->sortable()
                ->label(__('admin_order.country'))
                ->formatStateUsing(fn($state)=>Countries::find($state)?->name),
            TextColumn::make('city_id')
                ->sortable()
                ->label(__('admin_order.city'))
                ->formatStateUsing(fn($state)=>Cities::find($state)?->name),
            TextColumn::make('description')
                ->sortable()
                ->label(__('admin_order.description'))
                ->limit(50)
                ->tooltip(function (TextColumn $column): ?string {
                    $state = $column->getState();

                    if (strlen($state) <= $column->getCharacterLimit()) {
                        return null;
                    }

                    // Only render the tooltip if the column content exceeds the length limit.
                    return $state;
                })
        ];
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
            'index' => Pages\ListActiveOrders::route('/'),
        ];
    }
    public static function getNavigationLabel(): string
    {
        return __('admin_settings.active');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin_settings.orders');
    }

    public static function getPluralLabel(): ?string
    {
        return __('admin_settings.orders');
    }
}
