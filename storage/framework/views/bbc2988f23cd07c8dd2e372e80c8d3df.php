<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['label' => '', 'name', 'class' => '', 'type' => null, 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false, 'mask' => '', 'placeholder' => '']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['label' => '', 'name', 'class' => '', 'type' => null, 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false, 'mask' => '', 'placeholder' => '']); ?>
<?php foreach (array_filter((['label' => '', 'name', 'class' => '', 'type' => null, 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false, 'mask' => '', 'placeholder' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php $required = ($req) ? "*" : ""  ?>
<label class="text-lg font-medium text-gray-800 mb-2"><?php echo e($label); ?> <?php echo e($required); ?></label>
<?php if($help): ?>
<div class="text-sm text-gray-600 mb-4"><?php echo e($help); ?></div>
<?php endif; ?>
<input
    value="<?php echo $saved; ?>"
    name="<?php echo e($name); ?>"
    id="<?php echo e($name); ?>"
    type="<?php echo e($type ?? 'text'); ?>"
    <?php echo e($disabled ? 'disabled' : ''); ?>

    <?php echo e($required ? 'required' : null); ?>

    placeholder="<?php echo e($placeholder); ?>"
    class="<?php echo e($class); ?> block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white">

<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/inputs/text.blade.php ENDPATH**/ ?>