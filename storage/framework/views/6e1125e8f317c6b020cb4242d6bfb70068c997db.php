<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['label' => "", 'name', 'help' => false, 'saved' => '', 'disabled' => false, 'req' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['label' => "", 'name', 'help' => false, 'saved' => '', 'disabled' => false, 'req' => false]); ?>
<?php foreach (array_filter((['label' => "", 'name', 'help' => false, 'saved' => '', 'disabled' => false, 'req' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php $required = ($req) ? "*" : ""  ?>
<label for="<?php echo e($name); ?>" class="block text-lg font-medium text-gray-800 mb-2"><?php echo e($label); ?> <?php echo e($required); ?></label>
<?php if($help): ?>
<div class="text-sm text-gray-600 mb-4"><?php echo e($help); ?></div>
<?php endif; ?>
<?php $required = ($req) ? "required" : ""  ?>
<textarea id="<?php echo e($name); ?>" <?php echo e($required); ?> name="<?php echo e($name); ?>" rows="5" class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focusring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" <?php echo e($disabled ? 'disabled' : ''); ?>><?php echo e($saved); ?></textarea>

<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/inputs/textarea.blade.php ENDPATH**/ ?>