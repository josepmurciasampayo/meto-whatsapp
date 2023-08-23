<!-- resources/views/components/country.blade.php -->
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false]); ?>
<?php foreach (array_filter((['name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php $countries = App\Models\EnumCountry::orderBy('name', 'asc')->get(); ?>

<?php $required = ($req) ? "*" : ""  ?>
<label class="text-lg font-medium text-gray-800 mb-2"><?php echo e($label); ?> <?php echo e($required); ?></label>
<?php if($help): ?>
    <div class="text-sm text-gray-600 italic mb-4"><?php echo e($help); ?></div>
<?php endif; ?>
<div class="relative">
    <?php $required = ($req) ? "required" : ""  ?>
    <select id="<?php echo e($name); ?>" name="<?php echo e($name); ?>" <?php echo e($required); ?>

            class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm">
        <option value="">Select a country</option>
        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($country->name); ?>" <?php echo e($saved == $country->name ? 'selected' : ''); ?>><?php echo e($country->name); ?> </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/inputs/country.blade.php ENDPATH**/ ?>