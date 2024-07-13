<?php

namespace App\Filament\Resources\OffersResource\Pages;

use App\Filament\Resources\ActiveOffersResource;
use App\Filament\Resources\OffersResource;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Offers;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListActiveOffers extends ListRecords
{
    protected static string $resource = ActiveOffersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->slideOver()
                ->form(OffersResource::getFormSchema())
                ->mutateFormDataUsing(function (array $data): array {
                    $country = Countries::find($data['country_id'])->name;
                    $city = Cities::find($data['city_id'])->name;
                    $address = $country . '+' . $city;
                    $address = preg_replace('/ /', '+', $address);

                    $key = ENV('GOOGLE_MAP_KEY');
                    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$key";

                    $geocode_stats = file_get_contents($url);
                    $output_deals = json_decode($geocode_stats);

                    if( count($output_deals->results ) ) {
                        $result = $output_deals->results[0];
                        $latitude = $result->geometry->location->lat;
                        $longitude = $result->geometry->location->lng;

                        $data['latitude'] = $latitude;
                        $data['longitude'] = $longitude;
                    }else{
                        $data['latitude'] = 0.0;
                        $data['longitude'] = 0.0;
                    }

                    return $data;
                }),
        ];
    }

    protected function getTableQuery(): ?Builder
    {
        return Offers::query()->where('is_active',1);
    }
}
