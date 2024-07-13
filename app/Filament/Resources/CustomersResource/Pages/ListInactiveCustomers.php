<?php

namespace App\Filament\Resources\CustomersResource\Pages;

use App\Filament\Resources\ActiveCustomersResource;
use App\Filament\Resources\InactiveCustomersResource;
use App\Models\Customers;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListInactiveCustomers extends ListRecords
{
    protected static string $resource = InactiveCustomersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver()
                ->modalWidth('md')
                ->form(ActiveCustomersResource::getFormSchema())
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return Customers::query()->where('status',false);
    }
}
