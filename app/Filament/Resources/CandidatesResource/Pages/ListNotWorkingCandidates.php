<?php

namespace App\Filament\Resources\CandidatesResource\Pages;

use App\Filament\Resources\CandidatesNotWorkingResource;
use App\Models\Candidate;
use App\Services\CandidateService;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Colors\Color;
use Filament\Tables\Actions\Action;

class ListNotWorkingCandidates extends ListRecords
{
    protected static string $resource = CandidatesNotWorkingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->form(CandidateService::getFormSchema())
                ->after(function(Actions\CreateAction $action){
                    $email = $action->getFormData()['email'];
                    $notes = $action->getFormData()['notes'];
                    if(!empty($notes))
                    {
                        $candidate = Candidate::where('email',$email)->first();
                        CandidateService::created_notes_save($candidate, $notes);
                    }
                })
                ->modalWidth('md')
                ->slideOver(),
        ];
    }


}
