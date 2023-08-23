<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['notes' => '']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['notes' => '']); ?>
<?php foreach (array_filter((['notes' => '']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
<form id="notes" name="notes" action="<?php echo e(route('saveNotes')); ?>" method="POST" class="mt-6 bg-gray-100 shadow-md rounded-lg p-6">
    <?php echo csrf_field(); ?>
    <div class="mb-3 text-center">
        <label for="notes" class="mb-1 text-center text-gray-800 block display-7">Take Notes <i class="fas fa-pencil"></i></label>
        <label for="notes" class="mb-1 text-gray-600 text-center block text-lg">Your notes are private and will follow you around on other pages if you update before leaving each page.</label>
        <div class="mx-auto w-full lg:w-3/4 xl:w-1/2">
            <textarea class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focusring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" id="notes" name="notes" rows="4"><?php echo e($notes); ?></textarea>
        </div>
    </div>
    
    <div class="text-end p-3">
        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><i class="fas fa-sync"></i> Update Notes <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    </div>
</form>
<?php } ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/notes-counselor.blade.php ENDPATH**/ ?>