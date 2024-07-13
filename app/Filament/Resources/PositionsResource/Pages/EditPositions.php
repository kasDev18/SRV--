<?php

namespace App\Filament\Resources\PositionsResource\Pages;

use App\Filament\Resources\PositionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPositions extends EditRecord
{
    protected static string $resource = PositionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
