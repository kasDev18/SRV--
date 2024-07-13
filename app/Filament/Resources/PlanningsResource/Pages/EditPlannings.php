<?php

namespace App\Filament\Resources\PlanningsResource\Pages;

use App\Filament\Resources\PlanningsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPlannings extends EditRecord
{
    protected static string $resource = PlanningsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
