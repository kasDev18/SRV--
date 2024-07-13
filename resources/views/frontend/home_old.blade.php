 @extends('frontend.layout')

@section('content')
<div id='topDecor' ></div>
<div>
    <a href="/create/cv" style="text-decoration: none"><button name='sendMessage' class="ksFormBtn1">{{__('cv.generate_cv')}}</button></a>
</div>
        <div id="aboutUs" >
            <div class="row scontent"  >
                <div class="d-none d-md-block col-6 aboutUsImg" ></div>
                <div class="col-12 col-md-6 aboutUsText" >
                    <h2 class="h2dark" >{{ __('home.about_us_head') }}</h2>
                    {!! __('home.about_us_content') !!}
                </div>
            </div>
        </div>
        <div class="contentLight" >
            <div class="row scontent topOffers" >


                <h2 class="h2dark" >{!! __('home.top_offers_head') !!}</h2>

                @if( count( $topOffers ) )
                    @foreach( $topOffers as $offer )
                     <div class="col-12 col-sm-6 col-lg-3">
                        <div class="oBox oListBox">
                            <div class="initial">
                               <div class="initialTop" >
                                   <h5 class="oBoxH5">{{ $offer->title }}</h5>
                                   @if($offer->country->name)
                                    <img src="/flags/{{ $offer->country->flag_id }}.svg" width="40" height="30" alt="{{ $offer->country->name }}" title="{{ $offer->country->name }}" />
                                   @endif
                               </div>
                                <div class="initialBottom" >
                                    <i class="fas fa-coins"></i>
                                     {{ $offer->currencies->sign . number_format($offer->salary, 2, '.', ',') }} {{$offer->brutto_netto}} <br />

                                    <i class="fas fa-map-marker-alt"></i> {{$offer->country?->name}}, {{$offer->city?->name}} <br />
                                    <i class="fas fa-home"></i>
                                        @if( $offer->cost_of_accommodation )
                                            {{$offer->currencies->sign . number_format($offer->cost_of_accommodation, 2, '.', ',') }}
                                       @else
                                           Darmowe
                                       @endif
                                </div>
                            </div>
                            <div class="content">
                                <a class="oListLink" href="offer/{{ $offer->id }}" >{{ __('menu.offer_see_detail') }}</a>
                            </div>
                        </div>
                     </div>
                    @endforeach
                @endif



        </div>
        </div>

        <div id="whyUs" >

            <div class='scontent whyUsInner' >

            <h2 class="h2dark">{{ __('home.why_us_head') }}</h2>
            <div class=" row" >
                <div class="col-12 col-md-4 whyUsContent" >
                    <i class="fas fa-user-check"></i>
                    <span class="h3dark" >{{ __('home.why_us_box1_head') }}</span>
                    <p>{{ __('home.why_us_box1_content') }}</p>
                </div>
                 <div class="col-12 col-md-4 whyUsContent" >
                    <i class="fas fa-chart-bar"></i>
                    <span class="h3dark" >{{ __('home.why_us_box2_head') }}</span>
                    <p>{{ __('home.why_us_box2_content') }}</p>
                </div>
                 <div class="col-12 col-md-4 whyUsContent" >
                    <i class="fas fa-globe"></i>
                    <span class="h3dark" >{{ __('home.why_us_box3_head') }}</span>
                    <p>{{ __('home.why_us_box3_content') }}</p>
                </div>
            </div>

        </div>

            <div id='bottomDecor' ></div>

        </div>
@endsection
