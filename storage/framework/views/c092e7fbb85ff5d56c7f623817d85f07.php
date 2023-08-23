<!-- radio.blade.php -->
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['options', 'name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false, 'wire']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['options', 'name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false, 'wire']); ?>
<?php foreach (array_filter((['options', 'name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false, 'wire']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<fieldset>
    <?php $required = ($req) ? '*' : '' ?>
    <label class="text-lg font-medium text-gray-800 mb-2"><?php echo e($label); ?> <?php echo e($required); ?></label>
    <?php if($help): ?>
        <div class="text-sm text-gray-600 mb-4"><?php echo e($help); ?></div>
    <?php endif; ?>
    <div class="flex flex-col gap-2 bg-white p-2">
        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $checked = ($value == $saved) ? 'checked' : '' ?>
            <?php $required = ($req) ? 'required' : '' ?>
            <label class="inline-flex items-center" <?php echo e($required); ?>>
                <input type="radio" class="form-radio h-4 w-4 text-green-600" <?php echo e($required ? 'required' : null); ?> id="<?php echo e($name . '[' . $value . ']'); ?>" name="<?php echo e($name); ?>" value="<?php echo e($value); ?>" <?php if(isset($wire)): ?> wire:model="<?php echo e($wire); ?>" <?php endif; ?> <?php echo e($checked); ?>>
                <span class="ml-2 text-m"><?php echo e($option); ?></span>
            </label>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</fieldset>





<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/inputs/radio.blade.php ENDPATH**/ ?>