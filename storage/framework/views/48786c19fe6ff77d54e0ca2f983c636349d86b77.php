<!-- date.blade.php -->
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['name', 'help' => false, 'saved' => null, 'label' => '', 'req' => false, 'class' => '', 'starting' => null]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['name', 'help' => false, 'saved' => null, 'label' => '', 'req' => false, 'class' => '', 'starting' => null]); ?>
<?php foreach (array_filter((['name', 'help' => false, 'saved' => null, 'label' => '', 'req' => false, 'class' => '', 'starting' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $startDate = ($saved) ? '"startDate": "'.$saved.'",' : '"startDate": "2001-01-01",';
    $required = ($req) ? "*" : ""
?>

<label class="text-lg font-medium text-gray-800 mb-2"><?php echo e($label); ?> <?php echo e($required); ?></label>
<?php if($help): ?>
    <div class="text-sm text-gray-600 italic mb-4"><?php echo e($help); ?></div>
<?php endif; ?>
<div class="text-sm text-gray-600 italic mb-4">You can also type the date as yyyy/mm/dd</div>
<div class="relative">
    <?php $required = ($req) ? "required" : ""  ?>
    <input id="<?php echo e($name); ?>" name="<?php echo e($name); ?>" value="<?php echo e($saved); ?>" <?php echo e($required); ?>

           class="<?php echo e($class); ?> datepicker block pl-3 pr-10 py-2 rounded-md border-indigo-300 focus:ring focus:ring-indigo-200  text-gray-900 sm:text-sm">
</div>

<?php if (! $__env->hasRenderedOnce('7ace0c18-cc1f-4d9b-91c5-a3a992b3a214')): $__env->markAsRenderedOnce('7ace0c18-cc1f-4d9b-91c5-a3a992b3a214'); ?>
    <!-- Date range picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $('.datepicker').daterangepicker({
            "singleDatePicker": true,
            "autoUpdateInput": true,
            "showDropdowns": true,
            "autoApply": true,
            "minYear": 2000,
            "maxYear": new Date().getFullYear() + 1,
            <?php echo $startDate; ?>

            "locale": {
                format: 'YYYY-MM-DD',
            },
            "opens": "center"
        });
    </script>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/inputs/date.blade.php ENDPATH**/ ?>