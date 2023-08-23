<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['label', 'name', 'help' => false, 'saved' => '', 'req' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['label', 'name', 'help' => false, 'saved' => '', 'req' => false]); ?>
<?php foreach (array_filter((['label', 'name', 'help' => false, 'saved' => '', 'req' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
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
<div class="flex flex-wrap items-center">
    <?php $required = ($req) ? "required" : ""  ?>
    <input type="number" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" value="<?php echo e($saved); ?>" class="mt-2 sm:mt-0 flex-1 ml-0 sm:ml-2 block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" pattern="\d{0,10}" <?php echo e($required); ?> min="0">
</div>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/inputs/number.blade.php ENDPATH**/ ?>