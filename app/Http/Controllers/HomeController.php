<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Offers;
use App\Models\Sectors;
use App\Providers\Filament\AdminPanelProvider;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {

        $topOffers = Offers::where('is_top_offer', 1)->where('is_active', 1)->get();
        if(FileHelper::map_widget(true))FileHelper::map_widget(\request()->url());
        $topOffers->load([
            'country',
            'city',
            'sector',
            'currencies',
            'contract'
        ]);

        return view('frontend.home', ['topOffers'=>$topOffers]);
    }

    public function show(Request $request, $id=false)
    {
        $offer = Offers::find($id);
        if(!$offer)
        {
            return redirect()->back();
        }
        return view('frontend.offer',['offer'=>$offer, 'title'=>' - ' . $offer->title, 'message' => '']);
    }

    public function offers(Request $request)
    {
        $notSearched = FALSE;

        if( isset( $request->szukaj ) )
        {

            $offersSearcher = Offers::where('is_active', 1);

            if( $request->kraj AND is_numeric( $request->kraj ) )
            {
                $searchCountry = Countries::where('id', $request->kraj )->first();
                $cities = Cities::where('country_id',$request->kraj)->orderBy('name')->get();
                if( $searchCountry )
                {
                    if( count( $cities ) )
                    {
                        $citiesId = [];
                        foreach( $cities as $city )
                        {
                            $citiesId[] = $city->id;

                        }
                        $offersSearcher->whereIn('city_id',  $citiesId);

                    }

                }
            }

            if( $request->miasto AND is_numeric( $request->miasto ) )
            {

                $offersSearcher->where('city_id', $request->miasto );
            }

            if( $request->kategoria AND is_numeric( $request->kategoria ))
            {
                $offersSearcher->where('sector_id',$request->kategoria);
            }

            if( $request->bez_wiekowki )
            {
                $offersSearcher->where('age_rate', 1 );
            }

            if( $request->bez_jezyka )
            {
                $offersSearcher->where('without_language', 1);
            }

            if( $request->userLocation )
            {
                $key=ENV('GOOGLE_MAP_KEY');
                $city= preg_replace('/ /', '+', $request->userLocation);//zamiana spacji na + w celu pobrania geolokalizacji miejscowości
                $geocode_stats = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$city&key=$key");
                $output_deals  = json_decode($geocode_stats);
                if( count($output_deals->results ) )
                {
                    $result = $output_deals->results[0];
                    $latitude = $result->geometry->location->lat;
                    $longitude = $result->geometry->location->lng;
                    $searchRadius = $request->radius;//@TODO czy z zakresu i jest int
                    if($searchRadius == 0) $searchRadius = 1;
                    $offersSearcher->whereRaw('SQRT(POW((offers.latitude - '.(double)$latitude.') * 110.57, 2) + POW((offers.longitude - '.(double)$longitude.') * 111.32, 2)) <= '.$searchRadius);
                }
            }


            $offers = $offersSearcher->get();

            if( !count($offers) )
            {
                $notSearched = TRUE;
                $offers = Offers::where('is_active', 1)->get();
            }

        }
        else
        {
            $offers = Offers::where('is_active', 1)->get();
        }
        $countries = Countries::all();
        $cities = Cities::query()->orderBy('name')->get();
        $branches = Sectors::all();

        return view('frontend.offers', ['offers'=>$offers,
            'title'=>' - Oferty',
            'countries'=>$countries,
            'notSearched'=>$notSearched,
            'cities' => $cities,
            'branches' => $branches
        ]);
    }

    public function apply(Request $request, $id)
    {
        FileHelper::check_if_file_exist($request,$id);
        $offer = Offers::find($id);

        if(!$offer)
        {
            return redirect()->back();
        }

        if( isset( $_POST['sendApplication'] ) )
        {
            $validator = Validator::make($request->all(),
                ['name' => 'required|min:6|max:255',
                    'email'=>'required|email',
                    'phone'=>'required',
                    'message_content'=>'required',
                    'consent'=>'required',
                    'cv'=>'required|max:25600|mimes:jpg,bmp,png,pdf,doc,docx,odt']);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['message_content'] = $request->message_content;
            $data['consent'] = 'Wyrażam zgodę na przetwarzanie moich danych osobowych dla potrzeb niezbędnych do realizacji procesu rekrutacji przez firmę K&S Holding Sp. z o .o. z siedzibą w Skawinie, ul. Graniczna 2K/4, 32-050 Skawina, zgodnie z Rozporządzeniem Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia 27 kwietnia 2016 r. w sprawie ochrony osób fizycznych w związku z przetwarzaniem danych osobowych i w sprawie swobodnego przepływu takich danych oraz uchylenia dyrektywy 95/46/WE (RODO).';

            Mail::send(['html'=>'mails/offer'], $data, function($message) use ($request, $offer){
                $message->to( config('mail.apply_mail_address') , 'Formularz aplikacji jobnl.eu')->subject('Aplikacja '.$offer->title);
                $message->from(config('mail.apply_mail_address'),'Formularz aplikacji jobnl.eu');
                $message->replyTo($request->email, $request->name);

                //  $message->attach($request->cv->getRealPath().'/'.$request->cv->getClientOriginalName());

                $message->attach($request->cv->getRealPath(),
                    [
                        'as' => $request->cv->getClientOriginalName(),
                        'mime' => $request->cv->getClientMimeType(),
                    ]);

            });

        }


        return view('frontend.offer',['offer'=>$offer, 'title'=>' - ' . $offer->title, 'message'=>'Application send successfully!']);
    }


    public function contact(Request $request)
    {
        $showContactFormMessage = false;
        return view('frontend.contact', ['showContactFormMessage'=>$showContactFormMessage, 'title'=>' - Contact']);
    }

    public function send_contact(Request $request)
    {
        $showContactFormMessage = false;//czy w widoku wyświetlić komunikat o poprawnej wysyłce wiadomości
        if( isset( $_POST['sendMessage'] ) )
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:6|max:255',
                'email'=>'required|email',
                'phone'=>'required',
                'message_content'=>'required',
                'g-recaptcha-response' => 'recaptcha',
                'cv'=>'max:25600|mimes:jpg,bmp,png,pdf,doc,docx,odt'
            ]);

            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }

            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone'] = $request->phone;
            $data['message_content'] = $request->message_content;

            Mail::send(['html'=>'mails/contact'], $data, function($message) use ($request){
                $message->to(config('mail.contact_mail_address') , 'Formularz kontaktowy jobnl.eu')->subject('Formularz kontaktowy jobnl.eu');
                $message->from(config('mail.contact_mail_address'),'Formularz kontaktowy jobnl.eu');
                $message->replyTo($request->email, $request->name);

                if($request->cv)
                {
                    $message->attach($request->cv->getRealPath(),
                        [
                            'as' => $request->cv->getClientOriginalName(),
                            'mime' => $request->cv->getClientMimeType(),
                        ]);
                }

            });

            $showContactFormMessage = TRUE;

        }
        return view('frontend.contact', ['showContactFormMessage'=>$showContactFormMessage, 'title'=>' - Kontakt']);
    }

    public function privacy_policy()
    {
        return view('frontend.privacy_policy');
    }
}
