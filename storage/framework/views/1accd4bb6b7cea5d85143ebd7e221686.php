<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($name); ?>'s Resume</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('<?php echo e(storage_path("fonts/DejaVuSans.ttf")); ?>') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }

        .footer {
            padding: 10px 0;
            text-align: center;
            width: 100%;
            position: fixed;
            bottom: 20px; /* 50px above the bottom */
            left: 0;
        }
        .footer small a{
            color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1><?php echo e($name); ?></h1>
        <p><?php echo e($email); ?> | <?php echo e($phone); ?> | <?php echo e($date_of_birth ? date_format(\Carbon\Carbon::make($date_of_birth),'M d, Y') : ''); ?> | <?php echo e($address); ?></p>
    </div>
    <div class="section">
        <h2><?php echo e(__('cv.education')); ?></h2>
        <ul>
            <?php if(count($education) > 0): ?>
                <?php $__currentLoopData = $education; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <strong><?php echo e($value); ?></strong>
                        <br><small>(<?php echo e($educ_from_date[$key]); ?> to <?php echo e($educ_to_date[$key]); ?>)</small>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>
        </ul>
    </div>
    <div class="section">
        <h2><?php echo e(__('cv.experience')); ?></h2>
        <ul>
            <?php if(count($experiences) > 0): ?>
                <?php $__currentLoopData = $experiences; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <strong><?php echo e($value); ?></strong>
                        <br><small>(<?php echo e($experience_from_date[$key]); ?> to <?php echo e($experience_to_date[$key]); ?>)</small>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>
        </ul>
    </div>
    <div class="section">
        <h2><?php echo e(__('cv.skills')); ?></h2>
        <ul>
            <?php if(count($skills) > 0): ?>
                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <strong><?php echo e($value); ?></strong>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </div>
    <div class="section">
        <h2><?php echo e(__('cv.language')); ?></h2>
        <ul>
            <?php if(count($languages) > 0): ?>
                <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <strong><?php echo e($value); ?></strong>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </ul>
    </div>

    <div class="section">
        <h2><?php echo e(__('cv.additional_info')); ?></h2>
        <ul>
            <?php
                $yes = __('cv.yes');
                $no = __('cv.no');
            ?>

            <li><?php echo e(__('cv.include_dl')); ?>: <b><?php echo e($with_license ? $yes : $no); ?></b></li>
            <li><?php echo e(__('cv.own_transport')); ?>: <b><?php echo e($own_transport ? $yes : $no); ?></b></li>
        </ul>
    </div>
    <div class="footer">
        <div style="margin-bottom: 10px; text-align: left !important;">
            <small><?php echo e(__('cv.consent')); ?></small>
        </div>
        <small><a href="https://jobnl.eu/" style="text-decoration: none;">jobnl.eu</a></small>
    </div>
</div>
</body>
</html>
<?php /**PATH C:\laragon\www\SRV!^\resources\views/cv/template_cv.blade.php ENDPATH**/ ?>