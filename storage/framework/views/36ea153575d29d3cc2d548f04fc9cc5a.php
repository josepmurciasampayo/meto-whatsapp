<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'theme' => null,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'theme' => null,
]); ?>
<?php foreach (array_filter(([
    'theme' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div>
    <?php
        $responsiveCheckboxColumnName = PowerComponents\LivewirePowerGrid\Responsive::CHECKBOX_COLUMN_NAME;

        $isCheckboxFixedOnResponsive = isset($this->setUp['responsive']) && in_array($responsiveCheckboxColumnName, data_get($this->setUp, 'responsive.fixedColumns')) ? true : false;
    ?>
    <th
        <?php if($isCheckboxFixedOnResponsive): ?> fixed <?php endif; ?>
        scope="col"
        class="<?php echo e($theme->thClass); ?>"
        style="<?php echo e($theme->thStyle); ?>"
        wire:key="<?php echo e(md5('checkbox-all')); ?>"
    >
        <div class="<?php echo e($theme->divClass); ?>">
            <label class="<?php echo e($theme->labelClass); ?>">
                <input
                    class="<?php echo e($theme->inputClass); ?>"
                    type="checkbox"
                    wire:click="selectCheckboxAll"
                    wire:model.defer="checkboxAll"
                >
            </label>
        </div>
    </th>
</div>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/vendor/livewire-powergrid/components/checkbox-all.blade.php ENDPATH**/ ?>