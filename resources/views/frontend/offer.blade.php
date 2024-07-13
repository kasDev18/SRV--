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
<div class="contentLight offerViewContent" >
    @if($message)
        <div style="
        margin-left: 60px;
        margin-right: 60px;
        padding: 30px;
        border-radius: 10px;
        border: 1px solid rgba(58,189,102,0.88);
        background-color: rgba(76,238,134,0.58);
        margin-bottom: 20px;
    ">
        <span style="
            margin-left: 10px;
            padding: 10px;
            "
        ><strong>{{ __('offers.apply_success_message') }}</strong>
            <a href="/offer/{{$offer->id}}" style="float: right; text-decoration: none; color: #4a5568">x</a>
        </span>
        </div>
    @endif


    <div class="scontent" >
        <div class="row offerBox" >
            <div class="col-12" >
                <h2 class="h2green offerTitle">{{$offer->title}}</h2>
                <div class="offerDesc" >
                    <h3 class="h3pink">{{__('admin_offer.job_description')}}</h3>
                {!!$offer->job_description!!}
                </div>

                @if( $offer->requirements )
                <h3 class="h3pink">{{__('admin_offer.requirements')}}</h3>

                {!!$offer->requirements!!}

                @endif

                  @if( $offer->we_offer )
                <h3 class="h3pink">{{__('admin_offer.we_offer')}}</h3>

                {!!$offer->we_offer!!}

                @endif




            </div>
            <div class="col-12" >
                <div class="row infoSectionBox" >
                    <div class="col-12 col-sm-6 col-lg-4 offerInfoDetail" >

                        <div class='infoSectionIcon'>
                            <span class="oInfHead" ><i class="fas fa-coins"></i></span>
                </div>
                <div class='infoSection'>
                               <b>{{ __('offers.offer_box_rate') }}:</b><br />
                    {{ $offer->currencies->sign . number_format($offer->salary, 2, '.', ',') }} {{$offer->brutto_netto}}

                @if( $offer->payment_per_hour_2 )
                <br />
                II zmiana: {{ number_format($offer->payment_per_hour_2, 2, '.', '')  }}
                @if( !empty( $offer->payment_currency ) )
                @if( $offer->payment_currency == 'EUR' )
                        &euro;
                    @else
                        {{ $offer->payment_currency }}
                    @endif
                @endif
                {{$offer->payment_type}}

                @endif

                @if( $offer->payment_per_hour_3 )
                <br />
                III zmiana: {{ number_format($offer->payment_per_hour_3, 2, '.', '')  }}
                @if( !empty( $offer->payment_currency ) )
                @if( $offer->payment_currency == 'EUR' )
                        &euro;
                    @else
                        {{ $offer->payment_currency }}
                    @endif
                @endif
                {{$offer->payment_type}}

                @endif
                </div>

                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 offerInfoDetail" >

                        <div class='infoSectionIcon'>
                            <span class="oInfHead" ><i class="fas fa-home"></i>  </span>
                        </div>
                        <div class='infoSection'>
                              <b>{{ __('offers.offer_box_accommodation') }}:</b><br />
                                @if( $offer->cost_of_accommodation )
                                  {{$offer->currencies->sign . number_format($offer->cost_of_accommodation, 2, '.', ',') }}
                                @else
                                {{ __('offers.free') }}
                                @endif
                        </div>

                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 offerInfoDetail" >

                        <div class='infoSectionIcon'>
                            <span class="oInfHead" ><i class="fas fa-clinic-medical"></i></span>
                </div>
                <div class='infoSection'>
                   <b>{{ __('offers.offer_box_insurance') }}:</b><br />
                    @if( $offer->cost_of_insurance )
                        {{$offer->currencies->sign . number_format($offer->cost_of_insurance, 2, '.', ',') }}
                    @else
                        {{ __('offers.free') }}
                    @endif

                </div>



                    </div>
                    <div class="col-12 col-sm-6 col-lg-4 offerInfoDetail" >
                        @if( $offer->contract )
                            <div class='infoSectionIcon'>
                                <span class="oInfHead" ><i class="fas fa-file-signature"></i>  </span>
                            </div>
                            <div class='infoSection'>
                                 <b>{{ __('offers.offer_box_type_of_contract') }}:</b><br />
                                 {{ $offer->contract->name }}

                            </div>
                         @endif
                    </div>

                   <div class="col-12 col-sm-6 col-lg-4 offerInfoDetail" >
                        @if( $offer->payout_system )
                           <div class='infoSectionIcon'>
                                <span class="oInfHead" ><i class="fas fa-credit-card"></i></span>
                           </div>
                           <div class='infoSection'>
                               <b>{{ __('offers.offer_box_payout') }}:</b><br/>
                               @if($offer->payout_system == 'weekly')
                                   {{ __('admin_offer.weekly') }}
                               @elseif($offer->payout_system == 'monthly')
                                   {{ __('admin_offer.monthly') }}
                               @else
                                    {{$offer->payout_system}}
                               @endif

                           </div>
                      @endif
                   </div>
                @if($offer->cost_of_transport)
                   <div class="col-12 col-sm-6 col-lg-4 offerInfoDetail" >
                         <div class='infoSectionIcon'>
                            <span class="oInfHead" ><i class="fas fa-car"></i></span>
                        </div>

                       <div class='infoSection'>
                           <b>{{ __('offers.offer_box_transport') }}:</b><br />
                           @if( $offer->cost_of_transport )
                               {{$offer->currencies->sign . number_format($offer->cost_of_transport, 2, '.', ',') }}
                           @else
                               {{ __('offers.free') }}
                           @endif
                       </div>

                    </div>
                @endif
                     <div class="col-12 col-sm-6 col-lg-4 offerInfoDetail" >
                        <div class='infoSectionIcon'>
                            <span class="oInfHead" ><i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <div class='infoSection'>
                            <b>{{ __('offers.offer_box_location') }}:</b><br/>
                             {{ $offer->country->name }}, {{ $offer->city->name }}
                        </div>
                     </div>
                     <div class="col-12 col-sm-6 col-lg-4 offerInfoDetail" >
                         <div class='infoSectionIcon'>
                            <span class="oInfHead" ><i class="fas fa-phone-alt"></i></span>
                        </div>
                        <div class='infoSection'>
                            <b>{{ __('offers.offer_box_telephone') }}:</b><br />
                            <a href="tel:+48733100050" class='offerContactPhone' >+48 733 100 050</a><br />
                            <a href="tel:+48733200050" class='offerContactPhone' >+48 733 200 050</a><br />
                        </div>
                     </div>

                    <div class="col-12 col-sm-6 col-lg-4 offerInfoDetail" >
                        <div class='infoSectionIcon'>
                            <span class="oInfHead" ><i class="fas fa-language"></i></span>
                        </div>

                         <div class='infoSection'>
                             <b>{{ __('offers.offer_language') }}:</b><br />
                             @if( $offer->languages AND !$offer->without_language )
                                {{$offer->languages->name}}
                             @else
                                {{ __('offers.no_language') }}
                             @endif
                         </div>
                    </div>
               </div>
            </div>
            <div class="col-12" >
                 <p class="offerInfoBottom">{{ __('offers.offer_apply_info') }}</p>
                 <p class='offerAgencyInfo' >{{ __('offers.offer_agency_number_info') }}</p>
            </div>
        </div>


    </div>

</div>


<div class="contentDark offerViewForm" >
    <div class="scontent" >
        <form method="POST" action="" class="ksFormOuter" enctype="multipart/form-data" >
             @csrf
             <span class="ksFormTitle" >{{ __('offers.form_head') }}</span>
             <div class="row">
                 <div class="col-12 col-md-6 ksForm" >
                     <input type='text' name='name' placeholder="{{ __('offers.field_name') }}" value='{{old("name")}}' />
                     @error('name')
                        <div class="fError">{{ $message }}</div>
                     @enderror

                     <input type='text' name='email' placeholder="{{ __('offers.field_email') }}" value='{{old("email")}}' />
                     @error('email')
                        <div class="fError">{{ $message }}</div>
                     @enderror

                     <input type='text' name='phone' placeholder="{{ __('offers.field_phone') }}" value='{{old("phone")}}' />
                     @error('phone')
                        <div class="fError">{{ $message }}</div>
                     @enderror

                     <label class="cvFile">
                         <input type='file' name='cv' placeholder="CV" value='{{old("cv")}}' id="cvInput"/>
                         <i class="fa fa-cloud-upload"></i>
                         <span id="fileName">{{ __('offers.field_cv') }}</span>
                     </label>
                     @error('cv')
                        <div class="fError">{{ $message }}</div>
                     @enderror
                 </div>
                 <div class="col-12 col-md-6  ksForm" >
                     <textarea name="message_content" placeholder="{{ __('offers.field_content') }}" >{{old("message_content")}}</textarea>
                     @error('message_content')
                        <div class="fError">{{ $message }}</div>
                     @enderror
                 </div>
             </div>
            <p class='consentBox' >
{{--                <input type="checkbox" name="consent" value="1" checked>--}}
                <div class="checkbox-wrapper-31">
                    <input type="checkbox" name="consent" value="1" checked>
                    <svg viewBox="0 0 35.6 35.6">
                        <circle class="background" cx="17.8" cy="17.8" r="17.8"></circle>
                        <circle class="stroke" cx="17.8" cy="17.8" r="14.37"></circle>
                        <polyline class="check" points="11.78 18.12 15.55 22.23 25.17 12.87"></polyline>
                    </svg>
                </div>
                {{ __('offers.form_checkbox') }}

            </p>
            @error('consent')
            <div class="fError">{{ $message }}</div>
            @enderror
            <button name='sendApplication' class="ksFormBtn" >{{ __('offers.form_btn') }}</button>
        </form>
    </div>
</div>
<script>
    document.getElementById('cvInput').addEventListener('change', function(event) {
        const fileNameSpan = document.getElementById('fileName');
        const input = event.target;

        if (input.files && input.files.length > 0) {
            fileNameSpan.textContent = input.files[0].name;
        } else {
            fileNameSpan.textContent = "{{ __('offers.field_cv') }}";
        }
    });
</script>
@endsection
