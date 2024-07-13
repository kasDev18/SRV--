<?php

namespace App\Filament\Resources\OrdersResource\Pages;

use App\Filament\Resources\ActiveOrdersResource;
use App\Filament\Resources\OrdersResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateOrders extends CreateRecord
{
    protected static string $resource = OrdersResource::class;

    protected function getFormSchema(): array
    {
        return ActiveOrdersResource::getFormSchema();
    }

    protected function getRedirectUrl(): string
    {
        return '/admin';
    }
}
