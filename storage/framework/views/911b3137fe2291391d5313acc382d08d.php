<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['saved' => array(), 'options', 'name', 'help' => false, 'label', 'pickOne' => false, 'req' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['saved' => array(), 'options', 'name', 'help' => false, 'label', 'pickOne' => false, 'req' => false]); ?>
<?php foreach (array_filter((['saved' => array(), 'options', 'name', 'help' => false, 'label', 'pickOne' => false, 'req' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<fieldset class="flex flex-col gap-2">
    <?php $required = ($req) ? '*' : '' ?>
    <label class="text-lg font-medium text-gray-800 mb-2"><?php echo e($label); ?> <?php echo e($required); ?></label>
    <?php if($help): ?>
    <div class="text-sm text-gray-600 mb-4"><?php echo e($help); ?></div>
    <?php endif; ?>

    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $checked = (in_array($id, $saved)) ? 'checked' : '' ?>
        <label class="inline-flex items-center">
            <?php $required = ($req) ? 'required' : '' ?>
            <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600" id="<?php echo e($name . '[' . $id . ']'); ?>" name="<?php echo e($name . '[' . $id . ']'); ?>" <?php echo e($checked); ?> <?php echo e($required); ?>>
            <span class="ml-2 text-sm"><?php echo $option; ?></span>
        </label>
        <?php if($pickOne): ?>
            <?php break; ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</fieldset>

<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/inputs/checkbox.blade.php ENDPATH**/ ?>