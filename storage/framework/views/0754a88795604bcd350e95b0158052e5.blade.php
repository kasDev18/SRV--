<?php extract(collect($attributes->getAttributes())->mapWithKeys(function ($value, $key) { return [Illuminate\Support\Str::camel(str_replace([':', '.'], ' ', $key)) => $value]; })->all(), EXTR_SKIP); ?>
@props(['color','disabled','form','href','icon','iconSize','keyBindings','labelSrOnly','tag','target','tooltip','type','wire:click','wire:target','xOn:click','class','outlined','labeledFrom','iconPosition','iconSize','labeledFrom','iconPosition'])
<x-filament-database-schedule::button :color="$color" :disabled="$disabled" :form="$form" :href="$href" :icon="$icon" :icon-size="$iconSize" :key-bindings="$keyBindings" :label-sr-only="$labelSrOnly" :tag="$tag" :target="$target" :tooltip="$tooltip" :type="$type" :wire:click="$wireClick" :wire:target="$wireTarget" :x-on:click="$xOnClick" :class="$class" :outlined="$outlined" :labeledFrom="$labeledFrom" :iconPosition="$iconPosition" :iconSize="$iconSize" :labeled-from="$labeledFrom" :icon-position="$iconPosition" >

{{ $slot ?? "" }}
</x-filament-database-schedule::button>