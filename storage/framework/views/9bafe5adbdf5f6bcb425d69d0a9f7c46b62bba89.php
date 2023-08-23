<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['href', 'icon', 'text']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['href', 'icon', 'text']); ?>
<?php foreach (array_filter((['href', 'icon', 'text']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<a href="<?php echo e($href); ?>" class="inline-flex items-center bg-green-200 border border-dashed border-gray-400 rounded-xl p-2 hover:bg-green-400 transition-colors">
    <i class="<?php echo e($icon); ?> text-2xl text-green-900 mr-2"></i>
    <span class="text-base font-medium text-green-900"><?php echo e($text); ?></span>
</a>

<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/icon-link.blade.php ENDPATH**/ ?>