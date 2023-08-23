<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['label' => '', 'name', 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['label' => '', 'name', 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false]); ?>
<?php foreach (array_filter((['label' => '', 'name', 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<?php $required = ($req) ? "*" : "" ?>
<label for="<?php echo e($name); ?>" class="block font-bold text-l text-gray-700 mt-2"><?php echo e(htmlspecialchars($label) ?? $slot); ?> <?php echo e($required); ?></label>

<?php if($help): ?>
    <div><?php echo e($help); ?></div>
<?php endif; ?>

<?php $required = ($req) ? "required" : "" ?>
<input value="<?php echo e($saved); ?>" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo e($required); ?> <?php echo $attributes->merge([
'class' => 'block h-10 w-full mb-6 rounded-md shadow-sm border border-gray-400 focus:border-blue-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 bg-green-100 text-green-800'
]); ?>>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/input.blade.php ENDPATH**/ ?>