<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startPush('css'); ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script>
    <?php $__env->stopPush(); ?>
    <div class="my-4 pb-5">
        <form method="POST" action="<?php echo e(route('emails.store')); ?>">
            <?php echo csrf_field(); ?>








            <div class="form-group d-block mt-5 pt-5 mb-4">
                <label for="key" class="w-100 mb-2">Key</label>
                <?php $__errorArgs = ['key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="small text-danger mt-0 mb-2 py-0"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <input type="text" class="form-control" id="key" name="key" value="<?php echo e(old('key')); ?>">
            </div>
            <div class="form-group d-block mb-4">
                <label for="subject" class="w-100 mb-2">Subject</label>
                <?php $__errorArgs = ['subject'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="small text-danger mt-0 mb-2 py-0"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <input type="text" class="form-control" id="subject" name="subject" value="<?php echo e(old('subject')); ?>">
            </div>
            <div class="form-group d-block mb-4">
                <label for="from" class="w-100 mb-2">From</label>
                <?php $__errorArgs = ['from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="small text-danger mt-0 mb-2 py-0"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <input type="email" class="form-control" id="from" name="from" value="<?php echo e(old('from') ?? env('MAIL_FROM_ADDRESS')); ?>">
            </div>
            <div class="form-group d-block mb-4">
                <label for="to" class="w-100 mb-2">To</label>
                <?php $__errorArgs = ['to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="small text-danger mt-0 mb-2 py-0"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <textarea rows="5" class="form-control" id="to" name="to" value="<?php echo e(old('to')); ?>" data-role="tagsinput" placeholder="example1@gmail.com,example2@gmail.com,example3@gmail.com"></textarea>
            </div>
            <div class="d-flex">
                <div class="col">
                    <button class="btn btn-green text-white">Submit</button>
                </div>
                <div class="col text-end">
                    <a href="<?php echo e(route('emails.index')); ?>" class="btn btn-warning text-white">Back</a>
                </div>
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
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/admin/emails/create.blade.php ENDPATH**/ ?>