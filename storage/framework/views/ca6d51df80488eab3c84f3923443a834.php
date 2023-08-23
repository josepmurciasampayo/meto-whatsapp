<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="my-4">
        <form>
            <div class="mb-4">
                <label>Available variables:</label>
                <div>
                    <span data-value="{first}" class="badge variable-holder bg-success pointer">First name</span>
                    <span data-value="{last}" class="badge variable-holder bg-success pointer">Last name</span>
                    <span data-value="{email}" class="badge variable-holder bg-success pointer">Email</span>
                </div>
            </div>
            <div class="form-group d-block mb-4">
                <label for="key" class="w-100 mb-2">Key</label>
                <input type="text" class="form-control" id="key" name="key">
            </div>
            <div class="form-group d-block mb-4">
                <label for="subject" class="w-100 mb-2">Subject</label>
                <input type="text" class="form-control" id="subject" name="subject">
            </div>
            <div class="form-group d-block mb-4">
                <label for="from" class="w-100 mb-2">From</label>
                <input type="email" class="form-control" id="from" name="from">
            </div>
            <div class="form-group d-block mb-4">
                <label for="to" class="w-100 mb-2">To</label>
                <input type="text" class="form-control" id="to" name="to">
            </div>
            <div class="form-group">
                <button class="btn btn-green text-white">Submit</button>
            </div>
        </form>
    </div>

    <script>
        let varHolders = document.querySelectorAll('.variable-holder')
        varHolders.forEach(varHolder => {
            varHolder.addEventListener('click', () => {
                document.querySelector('#subject').value += ' ' + varHolder.getAttribute('data-value')
            })
        })
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/admin/emails/add.blade.php ENDPATH**/ ?>