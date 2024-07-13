<?php

namespace App\Filament\Resources\CandidatesResource\Pages;

use App\Filament\Resources\CandidatesWorkingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkingCandidates extends EditRecord
{
    protected static string $resource = CandidatesWorkingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): ?string
    {
        return CandidatesWorkingResource::getUrl('index');
    }
}
