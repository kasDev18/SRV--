<?php

namespace App\Filament\Resources\CandidatesResource\Pages;

use App\Filament\Resources\CandidatesBlacklistResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlacklistCandidates extends ListRecords
{
    protected static string $resource = CandidatesBlacklistResource::class;

    protected function getHeaderActions(): array
    {
        return [
//            Actions\CreateAction::make()
//                ->form(CandidatesBlacklistResource::getFormSchema())
//                ->modalWidth('md')
//                ->slideOver(),
        ];
    }
}
