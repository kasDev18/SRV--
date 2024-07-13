<?php

namespace App\Http\Controllers;

use App\Models\Offers;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function refreshID(Request $request)
    {
        $offers = Offers::all();

        if(count($offers) < 1) return redirect()->back();

        $last_offer_id = $offers->last()->id;

        $new_id = $last_offer_id;
        foreach ($offers as $offer)
        {
            $new_id++;
            $offer->update([
                'id' => $new_id
            ]);
        }
        return redirect()->back();
    }
}
