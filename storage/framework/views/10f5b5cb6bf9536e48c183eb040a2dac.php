<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['progress']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['progress']); ?>
<?php foreach (array_filter((['progress']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php if($progress > 0): ?>
<div class="progress w-full h-6 text-xxs">
    <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo e($progress); ?>%" aria-valuenow="<?php echo e($progress); ?>" aria-valuemin="0" aria-valuemax="100"><?php echo e($progress); ?>%</div>
</div>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/progress-bar.blade.php ENDPATH**/ ?>