<?php

namespace App\Filament\Resources\CandidatesResource\Pages;

use App\Filament\Resources\CandidatesWorkingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkingCandidates extends ListRecords
{
    protected static string $resource = CandidatesWorkingResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make()
//                ->form(CandidatesWorkingResource::getFormSchema())
//                ->modalWidth('md')
//                ->slideOver(),
        ];
    }
}
