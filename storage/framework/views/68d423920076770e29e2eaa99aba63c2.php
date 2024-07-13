<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SZUKAMYPRACY.EU - Biuro pośrednictwa pracy <?php echo e($title ?? ''); ?></title>

    <script src="/js/jquery-3.6.0.min.js"></script>
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <script src="/js/bootstrap.bundle.min.js"></script>

    <meta property="og:title" content="szukamypracy.eu - biuro pośrednictwa pracy"/>
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://srv68915.seohost.com.pl/"/>
    <meta property="og:image" content="https://srv68915.seohost.com.pl/img/header-banner.jpg"/>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="/style.css?v=39">
    <link rel="preload" fetchpriority="high" loading=lazy as="image" href="/img/header-banner.jpg" type="image/jpg">

    <script src="/js/jquery.cookie.js"></script>

    <?php echo htmlScriptTagJsApi(); ?>


</head>
<body>

<div id="topInfoBar">
    <div class="row scontent">

        <div class="col-12 col-md-4">
            <i class="fas fa-home" style="color: #74D7AA;"></i> Szukamypracy.eu Graniczna 2K/4, 32-050 Skawina
        </div>
        <div class="col-12 col-md-4">
            <i class="far fa-clock" style="color: #74D7AA;"></i> <?php echo e(__('home.working_hours_head')); ?>

            : <?php echo e(__('home.working_hours_days')); ?>: 10-17
            <div id="setLang">
                

                <?php if( App::getLocale() == 'pl' ): ?>
                    <img src="/flags/en.png" alt="" srcset="" height="15" width="20">
                    <a href="/lang/en">EN</a>
                <?php else: ?>
                    <img src="/flags/pl.png" alt="" srcset="" height="15" width="20">
                    <a href="/lang/pl">PL</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div id="topMenuBar">
    <div class="row">
        <div class='col-12'>
            <div class="hamburger" onclick="toggleMenu()">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
            <div class="mobile-menu">
                <ul>
                    <li><a href="/"><?php echo e(__('menu.home')); ?></a></li>
                    <li><a href="/#aboutUs"><?php echo e(__('menu.about_us')); ?></a></li>
                    <li><a href="/#whyUs"><?php echo e(__('menu.why_us')); ?></a></li>
                    <li><a href="/offers"><?php echo e(__('menu.offers')); ?></a></li>
                    <li><a href="/contact"><?php echo e(__('menu.contact')); ?></a></li>
                    <li><a href="/create/cv"><?php echo e(__('menu.create_cv')); ?></a></li>
                    <?php if(App::getLocale() == 'pl' && Route::is('cv.create')): ?>
                        <li>
                            <a href="javascript:void(0);" onclick="submitToDifferentRoute('/download/en-cv')">
                                <?php echo e(__('menu.download_en_cv')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<?php echo $__env->yieldContent('content'); ?>


<footer>
    <div class="row scontent" style="color: #fff; padding: 20px; font-size: 14px;">

        <div class="col-12 col-md-6">

            <i class="fas fa-home" style="color: #74D7AA;"></i> Graniczna 2K/4, 32-050 Skawina
        </div>
        <div class="col-12 col-md-6">
            <i class="fas fa-at" style="color: #74D7AA;"></i> praca@szukamypracy.eu
        </div>


    </div>
    <div style="font-size: small;text-align: center;">
        All rights reserved © <?php echo e(date('Y')); ?> szukamypracy.eu
    </div>
    <div class="footerBar">
        <div class="scontent">
            <a class="fbLink" href="https://www.facebook.com/ksrecruitmentpl/" target="_blank"><i
                    class="fab fa-facebook-square" style="color: #60a5fa; font-size: 20px"></i></a>
            <a href="/privacy_policy" style="color: black"><?php echo e(__('menu.privacy_policy')); ?></a>
        </div>
    </div>

    <?php echo $__env->make('frontend.cookie_card', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</footer>

<script src="/script.js"></script>
</body>
</html>
<?php /**PATH /home/srv68915/domains/srv68915.seohost.com.pl/public_html/resources/views/frontend/layout.blade.php ENDPATH**/ ?>