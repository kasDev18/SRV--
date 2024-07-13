<?php

declare(strict_types=1);

namespace App\Filament\Resources\Actions;

use App\Models\Note;
use App\Models\Orders;
use App\Services\CandidateService;
use App\Services\ProjectService;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use App\Models\Candidate;
use App\Services\OrderService;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CandidateAddNotesAction extends Action
{
    const ACTION_NAME = 'addNotesCandidate';

    public static function make($name = self::ACTION_NAME): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(' ')
            ->tooltip(__('admin_candidate.add_notes'))
            ->icon('heroicon-o-document-plus')
            ->color('info')
            ->requiresConfirmation()
            ->modalIcon('heroicon-o-document-plus')
            ->modalHeading(function ($record){
                return __('admin_candidate.add_notes_msg1') . $record->fullName;
            })
            ->form([
                Textarea::make('notes')
                    ->label(__('admin_candidate.notes'))
                    ->rows(3)
                    ->required()
            ])
            ->action(function(Candidate $candidate,$livewire){
                $notes = $livewire->mountedTableActionsData[0]['notes'];
                try {
                    $new_notes = new Note();
                    $new_notes->candidate_id = $candidate->id;
                    $new_notes->notes = $notes;
                    $new_notes->user_id = auth()->id();
                    $new_notes->save();

                    $candidate->updated_at = now();
                    $candidate->save();

                    Notification::make()
                        ->title('Success')
                        ->body('Candidate notes added successfully')
                        ->success()
                        ->send();
                }catch (\Exception $exception){
                    Notification::make()
                        ->title('Error')
                        ->body('Failed to add notes to candidate.')
                        ->danger()
                        ->send();
                    throw new \Exception($exception->getMessage());
                }
            })
            ->modalDescription(__('admin_candidate.add_notes_msg2'));
    }
}

