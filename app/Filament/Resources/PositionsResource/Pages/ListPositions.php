<?php

namespace App\Filament\Resources\PositionsResource\Pages;

use App\Filament\Resources\PositionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPositions extends ListRecords
{
    protected static string $resource = PositionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->slideOver()
            ->modalWidth('md')
            ,
        ];
    }
}
