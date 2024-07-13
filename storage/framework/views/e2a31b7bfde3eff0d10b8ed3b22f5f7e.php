<div
    <?php echo e($attributes
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)); ?>

>
    <?php echo e($getChildComponentContainer()); ?>

</div>
<?php /**PATH /home/srv68915/domains/srv68915.seohost.com.pl/public_html/vendor/filament/forms/src/../resources/views/components/group.blade.php ENDPATH**/ ?>