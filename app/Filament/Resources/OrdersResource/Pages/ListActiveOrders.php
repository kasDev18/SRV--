<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use App\Filament\Resources\ActiveOrdersResource;
use App\Models\Orders;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListActiveOrders extends ListRecords
{
    protected static string $resource = ActiveOrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->form(ActiveOrdersResource::getFormSchema())
                ->slideOver()
                ->modalWidth('md')
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return Orders::query()->where('is_active', Orders::STATUS_ACTIVE);
    }
}
