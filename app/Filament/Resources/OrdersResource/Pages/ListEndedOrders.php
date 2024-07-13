<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use App\Filament\Resources\ActiveOrdersResource;
use App\Filament\Resources\EndedOrdersResource;
use App\Filament\Resources\OrdersResource;
use App\Models\Orders;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListEndedOrders extends ListRecords
{
    protected static string $resource = EndedOrdersResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return Orders::query()->where('is_active', Orders::STATUS_FINISHED);
    }
}
