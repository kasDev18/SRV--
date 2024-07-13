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

<?php $__env->startSection('content'); ?>
    
    <!--
    <?php if( count( $offers ) ): ?>

        <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <a href="oferta,<?php echo e($offer->id); ?>" ><?php echo e($offer->title); ?></a><br />


        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php endif; ?>
    -->

    <script>
        citiesForCountry = [];
    </script>

    <div class="contentLight">

        <?php if( count( $offers ) ): ?>
            <div class="scontent">
                <div class="cHeader">
                    <h2 class="h2dark"><?php echo __('offers.offers_head'); ?></h2>
                </div>

                <div class='row'>
                    <div class='col-12'>


                        <form method="GET" action="" class="searchForm" style='display: block;'
                              enctype="multipart/form-data">
                            <div class='row'>
                                <?php if( count($countries) ): ?>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                                        <label for='kraj'>Kraj</label>
                                        <select name='kraj' id='serchCountry' class='offerSearcherSelect'>
                                            <option value="wszystkie">Wszystkie</option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <script>
                                                tmp = [];
                                            </script>
                                            <?php if( count( $cities ) ): ?>
                                                <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <script>
                                                        if (<?php echo e($city->country_id); ?> == <?php echo e($country->id); ?>) tmp[<?php echo e($city->id); ?>] = "<?php echo e($city->name); ?>";
                                                    </script>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                            <script>
                                                citiesForCountry["<?php echo e($country->id); ?>"] = tmp;
                                            </script>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>

                                    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                                        <label for='miasto'>Miasto</label>
                                        <select name='miasto' id='serchCity' class='offerSearcherSelect'>
                                            <option value='wszystkie'>Wszystkie</option>
                                        </select>
                                    </div>

                                <?php endif; ?>


                                <div class="col-12 col-sm-12 col-md-6 col-lg-3">
                                    <label for='kategoria'>Branża</label>
                                    <select name='kategoria' class='offerSearcherSelect'>
                                        <option value='wszystkie'>Wszystkie</option>
                                        <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $branch): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($branch->id); ?>"><?php echo e($branch->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6 col-lg-3 chbBox">
                                    <label for='bez_wiekowki'>

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
                            <?php
                                $api_key = ENV('GOOGLE_MAP_KEY');
                            ?>
                            <script
                                src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($api_key); ?>&libraries=places&callback=initAutocomplete&region=PL"
                                async defer></script>


                            <button name='szukaj' value='tak' class="ksFormBtn"><?php echo e(__('offers.search_btn')); ?></button>
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

                <?php if( $notSearched ): ?>

                    <p class='notSearchedInfo'>Niestety nie znaleziono ofert spełniających Twoje kryteria... ale może
                        zainteresują Cie inne z naszych ofert?</p>
                <?php endif; ?>


                <div class="row  topOffers">

                    <?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12 col-sm-6 col-lg-3">
                            <div class="oBox oListBox">
                                <div class="initial">
                                    <div class="initialTop" >
                                        <h5 class="oBoxH5"><?php echo e($offer->title); ?></h5>
                                        <?php if($offer->country->name): ?>
                                            <img src="/flags/<?php echo e($offer->country->flag_id); ?>.svg" width="40" height="40" alt="<?php echo e($offer->country->name); ?>" title="<?php echo e($offer->country->name); ?>"/>
                                        <?php endif; ?>
                                    </div>
                                    <div class="initialBottom" >


                                        <i class="fas fa-coins"></i>
                                        <?php echo e($offer->currencies->sign . number_format($offer->salary, 2, '.', ',')); ?> <?php echo e($offer->brutto_netto); ?> <br />

                                        <i class="fas fa-map-marker-alt"></i> <?php echo e($offer->country?->name); ?>, <?php echo e($offer->city?->name); ?> <br />
                                        <i class="fas fa-home"></i> <?php if( $offer->cost_of_accommodation ): ?>
                                            <?php echo e($offer->currencies->sign . number_format($offer->cost_of_accommodation, 2, '.', ',')); ?>

                                        <?php else: ?>
                                            Darmowe
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="content">
                                    <a class="oListLink" href="offer/<?php echo e($offer->id); ?>" ><?php echo e(__('menu.offer_see_detail')); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>
                </div>


            </div>
    </div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('frontend.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/srv68915/domains/srv68915.seohost.com.pl/public_html/resources/views/frontend/offers.blade.php ENDPATH**/ ?>