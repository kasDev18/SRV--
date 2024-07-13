<?php

namespace App\Filament\Resources\CandidatesResource\Pages;

use App\Filament\Resources\CandidatesDuringRecruitmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDuringRecruitmentCandidates extends ListRecords
{
    protected static string $resource = CandidatesDuringRecruitmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make()
//                ->form(CandidatesDuringRecruitmentResource::getFormSchema())
//                ->modalWidth('md')
//                ->slideOver(),
        ];
    }
}
