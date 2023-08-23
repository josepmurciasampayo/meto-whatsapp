<!-- select.blade.php -->
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['options', 'name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false, 'onchange' => false, 'class' => '']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['options', 'name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false, 'onchange' => false, 'class' => '']); ?>
<?php foreach (array_filter((['options', 'name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false, 'onchange' => false, 'class' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
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
    <div class="text-sm text-gray-600 italic mb-4"><?php echo e($help); ?></div>
<?php endif; ?>
<div class="relative <?php echo e($class); ?>">
    <?php $required = ($req) ? "required" : ""  ?>
    <?php $change = ($onchange) ? "onchange=$onchange" : ""  ?>
    <select <?php echo e($change); ?> id="<?php echo e($name); ?>" <?php echo e($required); ?> name="<?php echo e($name); ?>" class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm">
        <option value="">Select an option</option>

        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $selected = ($index == $saved) ? 'selected' : '' ?>
            <option value="<?php echo e($index); ?>" <?php echo e($selected); ?>><?php echo $value; ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </select>
    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none"></div>
</div>

<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/inputs/select.blade.php ENDPATH**/ ?>