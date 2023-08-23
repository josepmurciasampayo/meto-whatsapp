<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="text-end my-4">
        <a href="<?php echo e(route('emails.create')); ?>" class="btn btn-green text-white">Add email</a>
    </div>

    <?php echo $__env->make('_partials.response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <table class="table my-5">
        <thead>
            <tr>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Subject</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <th scope="row"><?php echo e($email->from); ?></th>
                    <td>
                        <?php $__currentLoopData = explode(',', $email->to); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span><?php echo e(($index + 1) . ' – ' . $value); ?></span><br />
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td title="<?php echo e($email->subject); ?>"><?php echo e(\Illuminate\Support\Str::limit($email->subject, 100)); ?></td>
                    <td><?php echo e($email->created_at); ?></td>
                    <td><?php echo e($email->updated_at); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td>No data found.</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php echo e($emails->links()); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/admin/emails/index.blade.php ENDPATH**/ ?>