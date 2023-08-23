<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['label', 'name', 'help' => false, 'saved' => false, 'req' => false, 'old' => false, 'json' => false,]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['label', 'name', 'help' => false, 'saved' => false, 'req' => false, 'old' => false, 'json' => false,]); ?>
<?php foreach (array_filter((['label', 'name', 'help' => false, 'saved' => false, 'req' => false, 'old' => false, 'json' => false,]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    if ($saved) {
        $saved = json_decode($saved->text);
        $savedCode = $saved->code;
        $savedNumber = $saved->number;
    }
    else if ($old) {
        $values = explode(",", $old);
        $savedCode = $old[0];
        $savedNumber = $old[1];
    }
    else if ($json) {
        $saved = json_decode(htmlspecialchars_decode($json));
        if (is_object($saved)) {
            $savedCode = $saved->code;
            $savedNumber = $saved->number;
        } else {
            $savedCode = $savedNumber = null;
        }
    }
    else {
        $savedCode = $savedNumber = null;
    }
?>

<?php $required = ($req) ? "*" : ""  ?>
<label class="text-lg font-medium text-gray-800 mb-2"><?php echo e($label); ?> <?php echo e($required); ?></label>
<?php if($help): ?>
    <div class="text-sm text-gray-600 mb-4"><?php echo e($help); ?></div>
<?php endif; ?>
<div class="flex flex-wrap items-center">
    <?php $required = ($req) ? "required" : ""  ?>
    <select name="<?php echo e($name); ?>[code]" id="<?php echo e($name); ?>[code]" class="block w-full sm:w-32 pr-2 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm" <?php echo e($required); ?>>
        <?php $__currentLoopData = $phoneCountries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($code); ?>" <?php echo e($code == $savedCode ? 'selected' : ''); ?>><?php echo e($country); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <input type="tel" name="<?php echo e($name); ?>[number]" id="<?php echo e($name); ?>[number]" value="<?php echo e($savedNumber); ?>" placeholder="Enter phone number" class="mt-2 sm:mt-0 flex-1 ml-0 sm:ml-2 block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" pattern="\d{0,10}" maxlength="12" oninput="this.value = this.value.replace(/\D/g, '')">
</div>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/inputs/phone.blade.php ENDPATH**/ ?>