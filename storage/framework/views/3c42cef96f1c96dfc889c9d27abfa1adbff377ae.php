<!-- resources/views/components/image-with-text.blade.php -->

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'imageSrc' => '',
    'alt' => '',
    'text' => '',
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'imageSrc' => '',
    'alt' => '',
    'text' => '',
]); ?>
<?php foreach (array_filter(([
    'imageSrc' => '',
    'alt' => '',
    'text' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<div>
    <img src="<?php echo e($imageSrc); ?>" alt="<?php echo e($alt); ?>" class="block mx-auto" style="width: 80px; height:auto"/>
    <div class="display-6 w-full text-center mt-2"><?php echo e($text); ?></div>
</div>

<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/image-with-text.blade.php ENDPATH**/ ?>