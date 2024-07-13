<?php

declare(strict_types=1);

namespace App\Filament\Resources\Actions;

use Filament\Tables\Actions\Action;
use App\Models\Candidate;
use App\Services\CandidateService;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;

class CandidateAddToBlacklistAction extends Action
{
    const ACTION_NAME = 'addToBlacklist';

    public static function make($name = self::ACTION_NAME): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('')
            ->tooltip(__('admin_candidate.add_blacklist'))
            ->icon('heroicon-m-archive-box-x-mark')
            ->color(Color::rgb('rgb(24,23,22)'))
            ->requiresConfirmation()
            ->modalIcon('heroicon-m-archive-box-x-mark')
            ->modalIconColor(Color::rgb('rgb(24,23,22)'))
            ->modalHeading(static fn (Candidate $candidate) => $candidate->full_name)
            ->modalDescription(__('admin_candidate.add_to_blacklist_msg'))
            ->action(static function (Candidate $candidate, CandidateService $service) {
                try {
                    $service->blacklist($candidate->id);
                    Notification::make()
                        ->title('Success')
                        ->body('Candidate is blacklisted')
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
            ->disabled(static fn (Candidate $record) => $record->is_working == Candidate::STATUS_BLACKLIST);
    }
}
