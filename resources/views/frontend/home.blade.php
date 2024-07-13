 @extends('frontend.layout')

@section('content')
<div id='topDecor'>

</div>
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
                <div class="containerVertical">
                    <div class="slideContainer">
                        <div class="mainContainerCarouselFinal" style="--screenWidth: 1612.8px;">
                            @if( count( $topOffers ) )
                                @foreach( $topOffers as $offer )
                                    <div class="slideTemplate backgroundColor"
                                         style="transform: translateY(0px); --ImgHeightSlide: 100px; --marginTop: 8px; --marginLeft: 0px; --marginRight: 0px; --buttonBgColor: #112130;">
                                        <img class="banner" src="{{asset('/img/ks_1501.png')}}" alt="">
                                        <h2 class="h2-tooltip">{{ $offer->title }}</h2>
                                        <div  class="slider_offers">
                                            @if($offer->country->name)
                                                <div>
                                                    <img class="offer_flag" src="/flags/{{ $offer->country->flag_id }}.svg" alt="{{ $offer->country->name }}" title="{{ $offer->country->name }}" />
                                                </div>
                                            @endif
                                            <div>
                                                <i class="fas fa-coins"></i> {{ $offer->currencies->sign . number_format($offer->salary, 2, '.', ',') }} {{$offer->brutto_netto}}
                                            </div>
                                            <div>
                                                <i class="fas fa-map-marker-alt"></i> {{$offer->country?->name}}, {{$offer->city?->name}}
                                            </div>
                                            <div>
                                                <i class="fas fa-home"></i>
                                                @if( $offer->cost_of_accommodation )
                                                    {{$offer->currencies->sign . number_format($offer->cost_of_accommodation, 2, '.', ',') }}
                                                @else
                                                    Darmowe
                                                @endif
                                            </div>
                                        </div>
                                        <a href="offer/{{ $offer->id }}">{{ __('menu.offer_see_detail') }}</a>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                    <div class="controlerFinalCarousel">
                        <div id="left_btn">
                            <img src="https://www.htmlcssbuttongenerator.com/image/arrowLeft.png" style="transform: rotate(180deg);"
                                  height="12px" width="12px" alt="controler to the right"></div>
                        <div id="right_btn">
                            <img src="https://www.htmlcssbuttongenerator.com/image/arrowLeft.png" height="12px" width="12px"
                                  alt="controler to the right"></div>
                    </div>
                </div>
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

<script>
    const container = document.querySelector(".mainContainerCarouselFinal");
    const slide = document.querySelector(".slideTemplate");
    // const prevBtn = document.querySelector(".controlerFinalCarousel div:nth-child(1)");
    // const nextBtn = document.querySelector(".controlerFinalCarousel div:nth-child(2)");

    const prevBtn = document.querySelector('#left_btn');
    const nextBtn = document.querySelector('#right_btn');
    let nbclick = 0;
    const nbSlide = 10;
    const {style: containerStyle, getComputedStyle: getCS} = window;
    nextBtn.addEventListener("click", () => {
        if (nbclick < nbSlide - 1) {
            nbclick++;
            updateScroll();
        }
    });
    prevBtn.addEventListener("click", () => {
        if (nbclick > 0) {
            nbclick--;
            updateScroll();
        }
    });

    function updateScroll() {
        const screenWidth = parseInt(getCS(container).getPropertyValue("--screenWidth").replace("px", ""));
        const slideHeight = parseInt(getCS(slide).getPropertyValue("--slideHeight").replace("px", ""));
        const scrollAmount = ((screenWidth - (slideHeight + 40)) / 2) * nbclick;
        container.scroll({left: scrollAmount, behavior: "smooth"});
    }
</script>
<script src="https://static.elfsight.com/platform/platform.js" data-use-service-core defer></script>
<div class="elfsight-app-9df20b66-e4b8-4860-8ad5-721d16bde7a4" data-elfsight-app-lazy></div>
@endsection


