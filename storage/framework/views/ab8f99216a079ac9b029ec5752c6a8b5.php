<?php if(data_get($setUp, 'header.softDeletes')): ?>
    <div class="btn-group">
        <button
            class="btn btn-secondary btn-sm dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
            <span>
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-powergrid::components.icons.trash','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-powergrid::icons.trash'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </span>
        </button>
        <ul class="dropdown-menu">
            <li wire:click="$emit('pg:softDeletes-<?php echo e($tableName); ?>', '')">
                <a
                    class="dropdown-item"
                    href="#"
                >
                    <?php echo app('translator')->get('livewire-powergrid::datatable.soft_deletes.without_trashed'); ?>
                </a>
            </li>
            <li wire:click="$emit('pg:softDeletes-<?php echo e($tableName); ?>', 'withTrashed')">
                <a
                    class="dropdown-item"
                    href="#"
                >
                    <?php echo app('translator')->get('livewire-powergrid::datatable.soft_deletes.with_trashed'); ?>
                </a>
            </li>
            <li wire:click="$emit('pg:softDeletes-<?php echo e($tableName); ?>', 'onlyTrashed')">
                <a
                    class="dropdown-item"
                    href="#"
                >
                    <?php echo app('translator')->get('livewire-powergrid::datatable.soft_deletes.only_trashed'); ?>
                </a>
            </li>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/vendor/livewire-powergrid/components/frameworks/bootstrap5/header/soft-deletes.blade.php ENDPATH**/ ?>