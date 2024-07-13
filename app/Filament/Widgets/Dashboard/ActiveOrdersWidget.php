<?php

namespace App\Filament\Widgets\Dashboard;

use App\Filament\Resources\ActiveOrdersResource;
use App\Models\Candidate;
use App\Models\Orders;
use Faker\Provider\Text;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use HusamTariq\FilamentDatabaseSchedule\Filament\Columns\ActionGroup;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;

class ActiveOrdersWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 1;
    protected static ?int $sort = 5;

    /**
     * @return mixed
     */

    public function table(Table $table): Table
    {
        return $table
                ->query(ActiveOrdersResource::getEloquentQuery()
                    ->where('is_active', Orders::STATUS_ACTIVE))
                ->columns([
                    TextColumn::make('topic')
                        ->label(__('admin_dashboard.topic'))
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('customer.company_name')
                        ->label(__('admin_dashboard.client'))
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('candidates_during_recruitment')
                        ->label(__('admin_dashboard.num_applied'))
                        ->default(0)
                        ->formatStateUsing(function ($record){
                            $count = Candidate::where('order_id',$record->id)->count();
                            return $count;
                        })
                        ->alignCenter(),
                    TextColumn::make('accepted_candidates')
                        ->alignCenter()
                        ->label(__('admin_dashboard.accepted_candidates'))
                        ->default(0)
                        ->formatStateUsing(function ($record){
                            $count = Candidate::where('order_id',$record->id)
                                ->where('is_working',Candidate::STATUS_WORKING)
                                ->count();
                            return $count;
                        }),

                    TextColumn::make('week_number')
                        ->label(__('admin_dashboard.week_number'))
                        ->alignCenter()
                ])->defaultSort('created_at','desc')
            ->actions([
                ActionGroup::make([
                    Action::make('Finish')
                        ->tooltip('Finish')
                        ->icon('heroicon-s-check-badge')
                        ->color('success')
                        ->requiresConfirmation()
                        ->modalIcon('heroicon-o-shield-check')
                        ->modalHeading(fn($record) => $record->topic)
                        ->modalDescription(__('admin_order.finish_msg'))
                        ->action(fn(Orders $record)=>$record->moveToFinish()),
                    Action::make('View Candidates')
                        ->tooltip('View')
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
                        ->tooltip('Edit')
                        ->form(ActiveOrdersResource::getFormSchema())
                        ->slideOver()
                        ->modalWidth('md'),
                    DeleteAction::make()
                        ->tooltip('Delete')
                        ->requiresConfirmation()
                ])


            ])

            ;
    }


    protected function getTableHeading(): string|Htmlable|null
    {
        return __('admin_dashboard.active_orders');
    }

}
