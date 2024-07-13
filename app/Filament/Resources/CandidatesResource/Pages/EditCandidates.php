<?php

namespace App\Filament\Resources\CandidatesResource\Pages;

use App\Filament\Resources\CandidatesNotWorkingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCandidates extends EditRecord
{
    protected static string $resource = CandidatesNotWorkingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
