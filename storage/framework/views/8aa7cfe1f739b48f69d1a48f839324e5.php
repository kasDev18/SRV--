<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['color','disabled','form','href','icon','iconSize','keyBindings','labelSrOnly','tag','target','tooltip','type','wire:click','wire:target','xOn:click','class','outlined','labeledFrom','iconPosition','iconSize','labeledFrom','iconPosition']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['color','disabled','form','href','icon','iconSize','keyBindings','labelSrOnly','tag','target','tooltip','type','wire:click','wire:target','xOn:click','class','outlined','labeledFrom','iconPosition','iconSize','labeledFrom','iconPosition']); ?>
<?php foreach (array_filter((['color','disabled','form','href','icon','iconSize','keyBindings','labelSrOnly','tag','target','tooltip','type','wire:click','wire:target','xOn:click','class','outlined','labeledFrom','iconPosition','iconSize','labeledFrom','iconPosition']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php if (isset($component)) { $__componentOriginalb24124643b29ac405341050a07e20dc3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb24124643b29ac405341050a07e20dc3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament-database-schedule::components.button','data' => ['color' => $color,'disabled' => $disabled,'form' => $form,'href' => $href,'icon' => $icon,'iconSize' => $iconSize,'keyBindings' => $keyBindings,'labelSrOnly' => $labelSrOnly,'tag' => $tag,'target' => $target,'tooltip' => $tooltip,'type' => $type,'wire:click' => $wireClick,'wire:target' => $wireTarget,'xOn:click' => $xOnClick,'class' => $class,'outlined' => $outlined,'labeledFrom' => $labeledFrom,'iconPosition' => $iconPosition]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament-database-schedule::button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($color),'disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($disabled),'form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($form),'href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($href),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'icon-size' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'key-bindings' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($keyBindings),'label-sr-only' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($labelSrOnly),'tag' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tag),'target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($target),'tooltip' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tooltip),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($type),'wire:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($wireClick),'wire:target' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($wireTarget),'x-on:click' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($xOnClick),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($class),'outlined' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($outlined),'labeledFrom' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($labeledFrom),'iconPosition' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconPosition),'iconSize' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconSize),'labeled-from' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($labeledFrom),'icon-position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($iconPosition)]); ?>

<?php echo e($slot ?? ""); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb24124643b29ac405341050a07e20dc3)): ?>
<?php $attributes = $__attributesOriginalb24124643b29ac405341050a07e20dc3; ?>
<?php unset($__attributesOriginalb24124643b29ac405341050a07e20dc3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb24124643b29ac405341050a07e20dc3)): ?>
<?php $component = $__componentOriginalb24124643b29ac405341050a07e20dc3; ?>
<?php unset($__componentOriginalb24124643b29ac405341050a07e20dc3); ?>
<?php endif; ?><?php /**PATH /home/srv68915/domains/srv68915.seohost.com.pl/public_html/storage/framework/views/0754a88795604bcd350e95b0158052e5.blade.php ENDPATH**/ ?>