<?php $helperClass = app('PowerComponents\LivewirePowerGrid\Helpers\Helpers'); ?>
<?php $actionRenderClass = app('PowerComponents\LivewirePowerGrid\Helpers\ActionRender'); ?>

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'actions' => null,
    'theme' => null,
    'row' => null,
    'tableName' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'actions' => null,
    'theme' => null,
    'row' => null,
    'tableName' => null,
]); ?>
<?php foreach (array_filter(([
    'actions' => null,
    'theme' => null,
    'row' => null,
    'tableName' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div>
    <?php if(isset($actions) && count($actions) && $row !== ''): ?>
        <td
            class="pg-actions <?php echo e($theme->table->tdBodyClass. ' ' .$theme->table->tdActionClass); ?>"
            style="<?php echo e($theme->table->tdBodyStyle .' '.$theme->table->tdActionStyle); ?>"
        >

            <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $customAction = null;
                    $actionClass = new \PowerComponents\LivewirePowerGrid\Helpers\Actions($action, $row, $primaryKey, $theme);

                ?>

                <?php if(!boolval($actionClass->ruleHide) && empty($customAction)): ?>
                    <?php if($actionClass->customRender): ?>
                        <?php echo $actionClass->customRender; ?>

                    <?php endif; ?>

                    <?php if($actionClass->isButton): ?>
                        <button <?php echo e($actionClass->getAttributes()); ?>>
                            <?php echo $actionClass->caption(); ?>

                        </button>
                    <?php endif; ?>

                    <?php if(filled($actionClass->bladeComponent)): ?>
                        <?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $actionClass->bladeComponent] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\DynamicComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['attributes' => $actionClass->bladeComponentParams]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
                    <?php endif; ?>

                    <?php if($actionClass->isLinkeable): ?>
                        <a <?php echo e($actionClass->getAttributes()); ?>>
                            <?php echo $actionClass->caption(); ?>

                        </a>
                    <?php endif; ?>

                    <?php if(filled($action->route) && !$actionClass->isButton): ?>
                        <?php if(strtolower($action->method) !== 'get'): ?>
                            <form
                                target="<?php echo e($action->target); ?>"
                                action="<?php echo e(route($action->route, $actionClass->parameters)); ?>"
                                method="post"
                            >
                                <?php echo method_field($action->method); ?>
                                <?php echo csrf_field(); ?>
                                <button
                                    type="submit"
                                    <?php echo e($actionClass->getAttributes()); ?>

                                >
                                    <?php echo $ruleCaption ?? $action->caption; ?>

                                </button>
                            </form>
                        <?php else: ?>
                            <a
                                href="<?php echo e(route($action->route, $actionClass->parameters)); ?>"
                                target="<?php echo e($action->target); ?>"
                                <?php echo e($actionClass->getAttributes()); ?>

                            >
                                <?php echo $actionClass->caption(); ?>

                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>

    <?php endif; ?>
</div>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/vendor/livewire-powergrid/components/actions.blade.php ENDPATH**/ ?>