<?php

declare(strict_types=1);

namespace App\Filament\Resources\Actions;

use App\Models\Note;
use App\Models\Offers;
use App\Models\Orders;
use App\Services\CandidateService;
use App\Services\ProjectService;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\Action;
use App\Models\Candidate;
use App\Services\OrderService;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;

class RefreshOfferIdAction extends Action
{
    const ACTION_NAME = 'refreshOfferId';

    public static function make($name = self::ACTION_NAME): static
    {
        return parent::make($name);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(' ')
            ->tooltip(__('admin_offer.refresh_id'))
            ->icon('heroicon-o-arrow-path')
            ->color('success')
            ->requiresConfirmation()
            ->modalIcon('heroicon-o-arrow-path')
            ->modalIconColor('success')
            ->modalHeading(function ($record){
                return 'Refresh ID for ' . $record->title . ' - ' . $record->id;
            })
            ->action(function(Offers $offer){
                try {
                    $offers = Offers::all();

                    if(count($offers) < 1)
                    {
                        Notification::make()
                            ->title('Error')
                            ->body('Offer ID refreshed failed.')
                            ->danger()
                            ->send();
                        return;
                    }
                    $old_id = $offer->id;
                    $last_offer_id = $offers->last()->id;
                    $new_id = $last_offer_id + 1;
                    $offer->update(['id'=>$new_id]);

                    Notification::make()
                        ->title('Success')
                        ->body('Offer ID is now updated from ' . $old_id . ' to ' . $new_id)
                        ->success()
                        ->send();
                }catch (\Exception $exception){
                    Notification::make()
                        ->title('Error')
                        ->body('Offer ID refreshed failed.')
                        ->danger()
                        ->send();
                    throw new \Exception($exception->getMessage());
                }
            })
            ->modalDescription(__('admin_offer.refresh_msg'));
    }
}

