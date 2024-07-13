<?php

namespace App\Filament\Resources\CandidatesResource\Pages;

use App\Filament\Resources\Actions\EditCandidateAddOrderAction;
use App\Filament\Resources\CandidatesNotWorkingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNotWorkingCandidates extends EditRecord
{
    protected static string $resource = CandidatesNotWorkingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditCandidateAddOrderAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): ?string
    {
        return CandidatesNotWorkingResource::getUrl('index');
    }

}
