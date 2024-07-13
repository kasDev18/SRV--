<?php

declare(strict_types=1);

namespace App\Filament\Resources\Actions;

use Filament\Tables\Actions\Action;
use App\Models\Candidate;
use App\Services\CandidateService;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;

class CandidateRemoveFromBlacklistAction extends Action
{
    const ACTION_NAME = 'removeFromBlacklist';

    public static function make($name = self::ACTION_NAME): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('')
            ->tooltip('Remove from Blacklist')
            ->icon('heroicon-m-arrow-path')
            ->color(Color::rgb('rgb(67,238,186)'))
            ->requiresConfirmation()
            ->modalIcon('heroicon-m-arrow-path')
            ->modalIconColor(Color::rgb('rgb(67,238,186)'))
            ->modalHeading(static fn (Candidate $candidate) => $candidate->full_name)
            ->modalDescription('Candidate will be removed from the blacklist. Are you sure?')
            ->action(static function (Candidate $candidate, CandidateService $service) {
                try {
                    $service->removeFromBlacklist($candidate->id);
                    Notification::make()
                        ->title('Success')
                        ->body('Candidate is removed from blacklist.')
                        ->success()
                        ->send();
                } catch (\Exception $e) {
                    Notification::make()
                        ->title('Error')
                        ->body('Candidate not found')
                        ->danger()
                        ->send();

                    throw new \Exception($e->getMessage());
                }
            })
            ->disabled(static fn (Candidate $record) => $record->is_working != Candidate::STATUS_BLACKLIST);
    }
}
