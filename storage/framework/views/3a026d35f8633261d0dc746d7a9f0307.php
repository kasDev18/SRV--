
<?php
$actions=$getActions();
?>
<div class="grid gap-1" style="width: max-content;grid-template-columns: repeat(3,minmax(0,1fr));">
<!--[if BLOCK]><![endif]--><?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <!--[if BLOCK]><![endif]--><?php if(! $action->isHidden()): ?>
                <?php echo e($action); ?>

            <?php endif; ?><!--[if ENDBLOCK]><![endif]-->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
</div>
<?php /**PATH /home/srv68915/domains/srv68915.seohost.com.pl/public_html/vendor/husam-tariq/filament-database-schedule/src/../resources/views/components/action-group.blade.php ENDPATH**/ ?>