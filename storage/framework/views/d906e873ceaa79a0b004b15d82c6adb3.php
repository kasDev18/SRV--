<?php
    use Filament\Support\Enums\ActionSize;
?>

<?php if (isset($component)) { $__componentOriginalbc4ad0ed4a304f68e90b5d787cbc97c5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbc4ad0ed4a304f68e90b5d787cbc97c5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-database-schedule::components.icon-button','data' => ['attributes' => \Filament\Support\prepare_inherited_attributes($attributes),'darkMode' => config('tables.dark_mode'),'size' => ActionSize::ExtraSmall]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-database-schedule::icon-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Filament\Support\prepare_inherited_attributes($attributes)),'dark-mode' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(config('tables.dark_mode')),'size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(ActionSize::ExtraSmall)]); ?>

    <?php echo e($slot); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbc4ad0ed4a304f68e90b5d787cbc97c5)): ?>
<?php $attributes = $__attributesOriginalbc4ad0ed4a304f68e90b5d787cbc97c5; ?>
<?php unset($__attributesOriginalbc4ad0ed4a304f68e90b5d787cbc97c5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbc4ad0ed4a304f68e90b5d787cbc97c5)): ?>
<?php $component = $__componentOriginalbc4ad0ed4a304f68e90b5d787cbc97c5; ?>
<?php unset($__componentOriginalbc4ad0ed4a304f68e90b5d787cbc97c5); ?>
<?php endif; ?>
<?php /**PATH /home/srv68915/domains/srv68915.seohost.com.pl/public_html/vendor/husam-tariq/filament-database-schedule/src/../resources/views/components/button.blade.php ENDPATH**/ ?>