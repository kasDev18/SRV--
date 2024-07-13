<?php

declare(strict_types=1);

namespace App\Filament\Resources\Actions;

use App\Models\Orders;
use App\Services\CandidateService;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use App\Models\Candidate;
use App\Services\OrderService;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;

class EditCandidateAddOrderAction extends Action
{
    const ACTION_NAME = 'addOrder';

    public static function make($name = self::ACTION_NAME): static
    {
        return parent::make($name);
    }
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('')
            ->tooltip(__('admin_candidate.assign_order'))
            ->form([
                Select::make('order_id')
                    ->label('Orders')
                    ->options(Orders::all()->where('is_active',Orders::STATUS_ACTIVE)->pluck('topic','id'))
            ])
            ->modalHeading(fn($record)=>$record->full_name)
            ->requiresConfirmation()
            ->icon('heroicon-s-shopping-cart')
            ->action(function(Candidate $candidate, OrderService $service){
                try {
                    $service->assignOrder($candidate->id,$this->formData['order_id']);
                    Notification::make()
                        ->title('Success')
                        ->body('Order assigned successfully.')
                        ->success()
                        ->send();
                } catch (\Exception $e) {
                    Notification::make()
                        ->title('Error')
                        ->body('Candidate / Order not found')
                        ->danger()
                        ->send();

                    throw new \Exception($e->getMessage());
                }

            }

            )
            ->color('success')
            ->modalDescription(__('admin_candidate.add_to_order_message'))
            ->getModalDescription();
    }
}

