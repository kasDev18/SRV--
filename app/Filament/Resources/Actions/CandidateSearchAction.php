<?php

declare(strict_types=1);

namespace App\Filament\Resources\Actions;

use App\Models\Note;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;
use App\Models\Candidate;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\View;

class CandidateSearchAction extends Action
{
    const ACTION_NAME = 'searchPatient';

    public static function make($name = self::ACTION_NAME): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Search')
            ->modalSubmitAction(false)
            ->modalCancelAction(false)
            ->icon('heroicon-o-magnifying-glass')
            ->color(Color::Lime)
            ->modalContent(function () {
                return View::make('livewire.livewire_wrapper.assigned-candidate-table-wrapper', [
                    'orderId' => [1],
                    'isSearch' => true
                ]);
            });
    }
}

