<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'theme' => '',
    'inline' => null,
    'filter' => null,
    'column' => '',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'theme' => '',
    'inline' => null,
    'filter' => null,
    'column' => '',
]); ?>
<?php foreach (array_filter(([
    'theme' => '',
    'inline' => null,
    'filter' => null,
    'column' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    extract($filter);
    unset($filter['className']);
    
    $defaultAttributes = \PowerComponents\LivewirePowerGrid\Filters\FilterNumber::getWireAttributes($field, $filter);
    
    $filterClasses = Arr::toCssClasses([$theme->inputClass, data_get($column, 'headerClass'), 'power_grid']);
    
    $params = array_merge([...data_get($filter, 'attributes'), ...$defaultAttributes, $filterClasses], $filter);
?>

<?php if($params['component']): ?>
    <?php unset($params['attributes']); ?>

    <?php if (isset($component)) { $__componentOriginal3bf0a20793be3eca9a779778cf74145887b021b9 = $component; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $params['component']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\DynamicComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => new \Illuminate\View\ComponentAttributeBag($params)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3bf0a20793be3eca9a779778cf74145887b021b9)): ?>
<?php $component = $__componentOriginal3bf0a20793be3eca9a779778cf74145887b021b9; ?>
<?php unset($__componentOriginal3bf0a20793be3eca9a779778cf74145887b021b9); ?>
<?php endif; ?>
<?php else: ?>
    <div
        class="<?php echo e($theme->baseClass); ?>"
        style="<?php echo e($theme->baseStyle); ?>"
    >
        <div>
            <input
                <?php echo e($defaultAttributes['inputStartAttributes']); ?>

                <?php if($inline): ?> style="<?php echo e($theme->inputStyle); ?> <?php echo e(data_get($column, 'headerStyle')); ?>" <?php endif; ?>
                type="text"
                class="<?php echo e($filterClasses); ?>"
                placeholder="<?php echo e($placeholder['min'] ?? __('Min')); ?>"
            >
        </div>
        <div class="mt-1">
            <input
                <?php echo e($defaultAttributes['inputEndAttributes']); ?>

                <?php if($inline): ?> style="<?php echo e($theme->inputStyle); ?> <?php echo e(data_get($column, 'headerStyle')); ?>" <?php endif; ?>
                type="text"
                class="<?php echo e($filterClasses); ?>"
                placeholder="<?php echo e($placeholder['min'] ?? __('Min')); ?>"
            >
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/vendor/livewire-powergrid/components/frameworks/bootstrap5/filters/number.blade.php ENDPATH**/ ?>