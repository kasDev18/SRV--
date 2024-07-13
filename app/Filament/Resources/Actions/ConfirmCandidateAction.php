<?php

declare(strict_types=1);

namespace App\Filament\Resources\Actions;

use App\Models\Orders;
use App\Services\CandidateService;
use App\Services\ProjectService;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use App\Models\Candidate;
use App\Services\OrderService;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ConfirmCandidateAction extends Action
{
    const ACTION_NAME = 'confirmCandidate';

    public static function make($name = self::ACTION_NAME): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Confirm')
            ->form([
                DatePicker::make('start_date')
                    ->label(__('admin_order.start_date'))
                    ->required()
                    ->default(Carbon::make(now()))
            ])
            ->visible(function($record)
            {
                return $record->is_working == Candidate::STATUS_DURING_RECRUITMENT ? 1 : 0;
            })
            ->modalHeading(fn($record)=>$record->full_name)
            ->requiresConfirmation()
            ->modalIcon('heroicon-s-check-badge')
            ->icon('heroicon-s-check-badge')
            ->action(function(Candidate $candidate, ProjectService $service){
                try {
                    $service->addProject($candidate->id,$this->formData['start_date']);
                    Notification::make()
                        ->title('Success')
                        ->body('Candidate confirmed successfully!')
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
            ->modalDescription(__('admin_order.confirm_candidate_message'))
            ->getModalDescription()
        ;
    }
}

