<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanningsResource\Pages;
use App\Filament\Resources\PlanningsResource\RelationManagers;
use App\Models\Candidate;
use App\Models\Customers;
use App\Models\Orders;
use App\Models\Plannings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use HusamTariq\FilamentDatabaseSchedule\Filament\Columns\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rules\Can;

class PlanningsResource extends Resource
{
    protected static ?string $model = Customers::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $pluralModelLabel = 'Planning';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultPaginationPageOption(50)
            ->columns([
                TextColumn::make('company_name')
                    ->label(__('admin_planning.company_name'))
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('id')
                    ->label(__('admin_planning.num_of_candidates'))
                    ->alignCenter()
                    ->sortable()
                    ->formatStateUsing(function ($state){
                        $orders = Orders::where('customer_id',$state)->pluck('id')->toArray();
                        $candidates = Candidate::whereIn('order_id',$orders)->where('is_working',Candidate::STATUS_WORKING)->count();
                        return $candidates;
                    })
            ])
            ->filters([
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('View Candidates')
                        ->label('')
                        ->tooltip(__('admin_planning.show_candidates'))
                        ->icon('heroicon-s-plus-circle')
                        ->color('info')
                        ->modalHeading(__('admin_planning.candidates'))
                        ->modalSubmitAction(false)
                        ->modalCancelAction(false)
                        ->modalContent(function ($record) {
                            $order_ids = Orders::where('customer_id',$record->id)->pluck('id');

                            return View::make('livewire.livewire_wrapper.assigned-candidate-table-wrapper', [
                                'orderId' => $order_ids,
                                'isPlanning'=>true
                            ]);
                        })
                        ->modalWidth('5xl')
                ])
            ])
            ->defaultSort('company_name')
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
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
            'index' => Pages\ListPlannings::route('/'),
//            'create' => Pages\CreatePlannings::route('/create'),
//            'edit' => Pages\EditPlannings::route('/{record}/edit'),
        ];
    }

    public static function getNavigationLabel(): string
    {
        return __('admin_settings.planning');
    }
}
