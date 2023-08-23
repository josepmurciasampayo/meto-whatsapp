<?php $helperClass = app('PowerComponents\LivewirePowerGrid\Helpers\Helpers'); ?>
<?php
    if ($action->singleParam) {
        $parameters = $helperClass->makeActionParameter($action->params);
    } else {
        $parameters = $helperClass->makeActionParameters($action->params);
    }
?>
<?php if($action->event !== '' && $action->to === ''): ?>
    <button
        wire:click='$emit("<?php echo e($action->event); ?>", <?php echo json_encode($parameters, 15, 512) ?>)'
        title="<?php echo e($action->tooltip); ?>"
        id="<?php echo e($action->id); ?>"
        class="power-grid-button <?php echo e(filled($action->class) ? $action->class : $theme->actions->headerBtnClass); ?>"
    >
        <?php echo $action->caption; ?>

    </button>
<?php elseif($action->event !== '' && $action->to !== ''): ?>
    <button
        wire:click='$emitTo("<?php echo e($action->to); ?>", "<?php echo e($action->event); ?>", <?php echo json_encode($parameters, 15, 512) ?>)'
        title="<?php echo e($action->tooltip); ?>"
        id="<?php echo e($action->id); ?>"
        class="power-grid-button <?php echo e(filled($action->class) ? $action->class : $theme->actions->headerBtnClass); ?>"
    >
        <?php echo $action->caption; ?>

    </button>
<?php elseif($action->view !== ''): ?>
    <button
        wire:click='$emit("openModal", "<?php echo e($action->view); ?>", <?php echo json_encode($parameters, 15, 512) ?>)'
        title="<?php echo e($action->tooltip); ?>"
        id="<?php echo e($action->id); ?>"
        class="power-grid-button <?php echo e(filled($action->class) ? $action->class : $theme->actions->headerBtnClass); ?>"
    >
        <?php echo $action->caption; ?>

    </button>
<?php else: ?>
    <?php if(strtolower($action->method) !== 'get'): ?>
        <form
            target="<?php echo e($action->target); ?>"
            action="<?php echo e(route($action->route, $parameters)); ?>"
            method="<?php echo e($action->method); ?>"
        >
            <?php echo method_field($action->method); ?>
            <?php echo csrf_field(); ?>
            <button
                type="submit"
                id="<?php echo e($action->id); ?>"
                title="<?php echo e($action->tooltip); ?>"
                class="power-grid-button <?php echo e(filled($action->class) ? $action->class : $theme->actions->headerBtnClass); ?>"
            >
                <?php echo $action->caption ?? ''; ?>

            </button>
        </form>
    <?php else: ?>
        <?php if(data_get($action, 'route')): ?>
            <a
                href="<?php echo e(route($action->route, $parameters)); ?>"
                id="<?php echo e($action->id); ?>"
                title="<?php echo e($action->tooltip); ?>"
                target="<?php echo e($action->target); ?>"
                class="power-grid-button <?php echo e(filled($action->class) ? $action->class : $theme->actions->headerBtnClass); ?>"
            >
                <?php echo $action->caption; ?>

            </a>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/vendor/livewire-powergrid/components/actions-header.blade.php ENDPATH**/ ?>