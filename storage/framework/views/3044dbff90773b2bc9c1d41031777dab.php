<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps([
    'theme' => null,
    'readyToLoad' => false,
]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps([
    'theme' => null,
    'readyToLoad' => false,
]); ?>
<?php foreach (array_filter(([
    'theme' => null,
    'readyToLoad' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>
<div <?php if(isset($this->setUp['responsive'])): ?> x-data="tableResponsive" <?php endif; ?>>
    <table
        class="table power-grid-table <?php echo e($theme->tableClass); ?>"
        style="<?php echo e($theme->tableStyle); ?>"
    >
        <thead
            class="<?php echo e($theme->theadClass); ?>"
            style="<?php echo e($theme->theadStyle); ?>"
        >
            <?php echo e($header); ?>

        </thead>
        <?php if($readyToLoad): ?>
            <tbody
                class="<?php echo e($theme->tbodyClass); ?>"
                style="<?php echo e($theme->tbodyStyle); ?>"
            >
                <?php echo e($rows); ?>

            </tbody>
        <?php else: ?>
            <tbody
                class="<?php echo e($theme->tbodyClass); ?>"
                style="<?php echo e($theme->tbodyStyle); ?>"
            >
                <?php echo e($loading); ?>

            </tbody>
        <?php endif; ?>
    </table>

    <?php if(isset($this->setUp['responsive'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                this.livewire.hook('message.processed', () => {
                    Alpine.nextTick(() => {
                        window.dispatchEvent(
                            new CustomEvent('pg-livewire-request-finished')
                        );
                    })
                })
                this.livewire.hook('message.failed', () => {
                    Alpine.nextTick(() => {
                        window.dispatchEvent(
                            new CustomEvent('pg-livewire-request-finished')
                        );
                    })
                })
            });
        </script>
    <?php endif; ?>
</div>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/vendor/livewire-powergrid/components/table-base.blade.php ENDPATH**/ ?>