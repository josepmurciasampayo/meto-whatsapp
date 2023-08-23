<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'theme' => '',
    'class' => '',
    'column' => null,
    'inline' => null,
    'filter' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'theme' => '',
    'class' => '',
    'column' => null,
    'inline' => null,
    'filter' => null,
]); ?>
<?php foreach (array_filter(([
    'theme' => '',
    'class' => '',
    'column' => null,
    'inline' => null,
    'filter' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $field = strval(data_get($filter, 'field'));
    $title = strval(data_get($filter, 'title'));
    
    $defaultAttributes = \PowerComponents\LivewirePowerGrid\Filters\FilterSelect::getWireAttributes($field, $title);
    
    $filterClasses = Arr::toCssClasses([$theme->selectClass, $class, data_get($column, 'headerClass'), 'power_grid']);
    
    $params = array_merge([...data_get($filter, 'attributes'), ...$defaultAttributes], $filter);
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
        <select
            class="<?php echo e($filterClasses); ?>"
            style="<?php echo e(data_get($column, 'headerStyle')); ?>"
            <?php echo e($defaultAttributes['selectAttributes']); ?>

        >
            <option value=""><?php echo e(trans('livewire-powergrid::datatable.select.all')); ?></option>
            <?php $__currentLoopData = data_get($filter, 'dataSource'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option
                    wire:key="select-<?php echo e($tableName); ?>-<?php echo e($key); ?>"
                    value="<?php echo e($item[data_get($filter, 'optionValue')]); ?>"
                >
                    <?php echo e($item[data_get($filter, 'optionLabel')]); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/vendor/livewire-powergrid/components/frameworks/bootstrap5/filters/select.blade.php ENDPATH**/ ?>