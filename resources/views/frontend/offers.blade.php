@extends('frontend.layout')

<style>
    .checkbox-wrapper-31:hover .check {
        stroke-dashoffset: 0;
    }

    .checkbox-wrapper-31 {
        position: relative;
        display: inline-block;
        width: 20px;
        height: 20px;
    }
    .checkbox-wrapper-31 .background {
        fill: rgba(204, 204, 204, 0.9);
        transition: ease all 0.6s;
        -webkit-transition: ease all 0.6s;
    }
    .checkbox-wrapper-31 .stroke {
        fill: none;
        stroke: #fff;
        stroke-miterlimit: 10;
        stroke-width: 2px;
        stroke-dashoffset: 100;
        stroke-dasharray: 100;
        transition: ease all 0.6s;
        -webkit-transition: ease all 0.6s;
    }
    .checkbox-wrapper-31 .check {
        fill: none;
        stroke: #fff;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-width: 2px;
        stroke-dashoffset: 22;
        stroke-dasharray: 22;
        transition: ease all 0.6s;
        -webkit-transition: ease all 0.6s;
    }
    .checkbox-wrapper-31 input[type=checkbox] {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        margin: 0;
        opacity: 0;
        -appearance: none;
        -webkit-appearance: none;
    }
    .checkbox-wrapper-31 input[type=checkbox]:hover {
        cursor: pointer;
    }
    .checkbox-wrapper-31 input[type=checkbox]:checked + svg .background {
        fill: #6ed0a5;
    }
    .checkbox-wrapper-31 input[type=checkbox]:checked + svg .stroke {
        stroke-dashoffset: 0;
    }
    .checkbox-wrapper-31 input[type=checkbox]:checked + svg .check {
        stroke-dashoffset: 0;
    }
</style>

@section('content')
    {{--    {{dd($offers)}}--}}
    <!--
    @if( count( $offers ) )

        @foreach( $offers as $offer )

            <a href="oferta,{{ $offer->id }}" >{{ $offer->title }}</a><br />


        @endforeach

    @endif
    -->

    <script>
        citiesForCountry = [];
    </script>

    <div class="contentLight">

        @if( count( $offers ) )
            <div class="scontent">
                <div class="cHeader">
                    <h2 class="h2dark">{!! __('offers.offers_head') !!}</h2>
                </div>

                <div class='row'>
                    <div class='col-12'>
{{--                        <button id='showSearchFormBtn'>{{ __('offers.show_form_btn') }} <i class="fas fa-search"></i>--}}
{{--                        </button>--}}
                        <form method="GET" action="" class="searchForm" style='display: block;'
                              enctype="multipart/form-data">
                            <div class='row'>
                                @if( count($countries) )
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                                        <label for='kraj'>Kraj</label>
                                        <select name='kraj' id='serchCountry' class='offerSearcherSelect'>
                                            <option value="wszystkie">Wszystkie</option>
                                            @foreach( $countries as $country )
                                                <option value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>

                                        @foreach( $countries as $country )
                                            <script>
                                                tmp = [];
                                            </script>
                                            @if( count( $cities ) )
                                                @foreach( $cities  as $city )
                                                    <script>
                                                        if ({{$city->country_id}} == {{$country->id}}) tmp[{{$city->id}}] = "{{$city->name}}";
                                                    </script>
                                                @endforeach
                                            @endif
                                            <script>
                                                citiesForCountry["{{$country->id}}"] = tmp;
                                            </script>
                                        @endforeach
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                                        <label for='miasto'>Miasto</label>
                                        <select name='miasto' id='serchCity' class='offerSearcherSelect'>
                                            <option value='wszystkie'>Wszystkie</option>
                                        </select>
                                    </div>

                                @endif


                                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                                    <label for='kategoria'>Branża</label>
                                    <select name='kategoria' class='offerSearcherSelect'>
                                        <option value='wszystkie'>Wszystkie</option>
                                        @foreach( $branches as $branch )
                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 chbBox">
                                    <label for='bez_wiekowki'>
{{--                                        <input type="checkbox" name="bez_wiekowki" value="tak">--}}
                                        <div class="checkbox-wrapper-31">
                                            <input type="checkbox" name="bez_wiekowki" value="tak"/>
                                            <svg viewBox="0 0 35.6 35.6">
                                                <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
                                                <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
                                                <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
                                            </svg>
                                        </div>
                                        Bez wiekówki
                                    </label><br/>
                                    <label for='bez_jezyka' class="noLanguageLabel">
{{--                                        <input type="checkbox" name="bez_jezyka" value="tak">--}}
                                        <div class="checkbox-wrapper-31">
                                            <input type="checkbox" name="bez_jezyka" value="tak"/>
                                            <svg viewBox="0 0 35.6 35.6">
                                                <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
                                                <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
                                                <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
                                            </svg>
                                        </div>
                                        Bez języka
                                    </label>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 offerSearcherHead">
                                    Lub znajdź pracę w swojej okolicy
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <label for='userLocation'>Gdzie jesteś?</label>
                                    <input type="text" class="offerSearcherTextInput" name="userLocation"
                                           id="userLocation">
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <label for='radius'>W jakiej odległości szukać?</label>
                                    <select name="radius" class='offerSearcherSelect'>
                                        <option value="0">0 km</option>
                                        <option value="5">5 km</option>
                                        <option value="10">10 km</option>
                                        <option value="20">20 km</option>
                                        <option value="50">50 km</option>
                                        <option value="100">100 km</option>
                                    </select>
                                </div>
                            </div>


                            <script>
                                var autocomplete;

                                function initAutocomplete() {
                                    autocomplete = new google.maps.places.Autocomplete(
                                        (document.getElementById('userLocation')),
                                        {types: ['(cities)'], componentRestrictions: {}});
                                    google.maps.event.addListener(autocomplete, 'place_changed', function () {
                                        var place = autocomplete.getPlace();
                                        $("[name='lat']").val(place.geometry.location.lat());
                                        $("[name='lng']").val(place.geometry.location.lng());
                                    });
                                }
                            </script>
                            @php
                                $api_key = ENV('GOOGLE_MAP_KEY');
                            @endphp
                            <script
                                src="https://maps.googleapis.com/maps/api/js?key={{$api_key}}&libraries=places&callback=initAutocomplete&region=PL"
                                async defer></script>


                            <button name='szukaj' value='tak' class="ksFormBtn">{{ __('offers.search_btn') }}</button>
                        </form>


                        <script>
                            $('#serchCountry').change(function () {
                                let cities = '<option value="wszystkie">Wszystkie</option>';
                                let selectedCountry = $(this).val();
                                let citiesArray = Object.entries(citiesForCountry[selectedCountry]);

                                // Sort the array of cities by the city name (the second element of each entry)
                                citiesArray.sort((a, b) => a[1].localeCompare(b[1]));

                                // Build the cities options HTML
                                citiesArray.forEach(([cityId, cityName]) => {
                                    cities += '<option value="' + cityId + '">' + cityName + '</option>';
                                });

                                $('#serchCity').html(cities);
                                console.log(citiesForCountry);
                            });



                            $('#showSearchFormBtn').click(function () {
                                $('.searchForm').toggle("slow");
                            });

                        </script>


                    </div>
                </div>

                @if( $notSearched )

                    <p class='notSearchedInfo'>Niestety nie znaleziono ofert spełniających Twoje kryteria... ale może
                        zainteresują Cie inne z naszych ofert?</p>
                @endif


                <div class="row  topOffers">

                    @foreach( $offers as $offer )
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="oBox oListBox">
                                <div class="initial">
                                    <div class="initialTop" >
                                        <h5 class="oBoxH5">{{ $offer->title }}</h5>
                                        @if($offer->country->name)
                                            <img src="/flags/{{ $offer->country->flag_id }}.svg" width="40" height="40" alt="{{ $offer->country->name }}" title="{{ $offer->country->name }}"/>
                                        @endif
                                    </div>
                                    <div class="initialBottom" >


                                        <i class="fas fa-coins"></i>
                                        {{ $offer->currencies->sign . number_format($offer->salary, 2, '.', ',') }} {{$offer->brutto_netto}} <br />

                                        <i class="fas fa-map-marker-alt"></i> {{$offer->country?->name}}, {{$offer->city?->name}} <br />
                                        <i class="fas fa-home"></i> @if( $offer->cost_of_accommodation )
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
    </div>

@endsection


