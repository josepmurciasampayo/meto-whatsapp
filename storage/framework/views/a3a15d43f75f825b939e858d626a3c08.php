<!-- resources/views/components/country-checkbox.blade.php -->
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

<?php
    $countries = App\Models\EnumCountry::orderBy('name', 'asc')->get();
    $savedCountries = explode(',', $saved);
    $checkedCount = 0;
?>

<?php $required = ($req) ? '*' : '' ?>
<label class="text-lg font-medium text-gray-800 mb-2"><?php echo e($label); ?> <?php echo e($required); ?></label>
<?php if($help): ?>
    <div class="text-sm text-gray-600 italic mb-4"><?php echo e($help); ?></div>
<?php endif; ?>
<div class="bg-white px-2" style="max-height: 150px; overflow: auto">
    <?php $required = ($req) ? 'required' : '' ?>
    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($checkedCount < 5): ?>
            <div>
                <input type="checkbox" id="<?php echo e($name); ?>[<?php echo e($country->id); ?>]" name="<?php echo e($name); ?>[<?php echo e($country->id); ?>]" value="<?php echo e($country->id); ?>" <?php echo e(in_array($country->id, $savedCountries) ? 'checked' : ''); ?> class="rounded text-green-600" onclick="checkLimit(this)">
                <label for="<?php echo e($name); ?>[<?php echo e($country->id); ?>]" class="ml-2" <?php echo e($required); ?>><?php echo e($country->name); ?></label>
            </div>
        <?php else: ?>
            <div>
                <input type="checkbox" id="<?php echo e($name); ?>[<?php echo e($country->id); ?>]" name="<?php echo e($name); ?>[<?php echo e($country->id); ?>]" value="<?php echo e($country->id); ?>" <?php echo e(in_array($country->id, $savedCountries) ? 'checked' : ''); ?> class="rounded text-green-600" disabled>
                <label for="<?php echo e($name); ?>[<?php echo e($country->id); ?>]" class="ml-2" <?php echo e($required); ?>><?php echo e($country->name); ?></label>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<script>
    function checkLimit(checkbox) {
        if (checkbox.checked) {
            if ($('input[type=checkbox]:checked').length > 5) {
                checkbox.checked = false;
                alert('You can only select up to 5 options.');
            } else {
                $checkedCount++;
            }
        } else {
            $checkedCount--;
        }
    }
</script>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/inputs/country-checkbox.blade.php ENDPATH**/ ?>