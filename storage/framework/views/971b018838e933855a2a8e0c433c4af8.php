<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <h3 class="mt-2 mb-5 display-7">Student Data</h3>

    <div style="font-size: 14px">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">To Review</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="request-tab" data-bs-toggle="tab" data-bs-target="#request-tab-pane" type="button" role="tab" aria-controls="request-tab-pane" aria-selected="false">Yes</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="maybe-tab" data-bs-toggle="tab" data-bs-target="#maybe-tab-pane" type="button" role="tab" aria-controls="maybe-tab-pane" aria-selected="false">Maybe</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="archived-tab" data-bs-toggle="tab" data-bs-target="#archived-tab-pane" type="button" role="tab" aria-controls="archived-tab-pane" aria-selected="false">No</button>
            </li>
        </ul>
        <div class="tab-content" id="students-tables">
            <div class="tab-pane fade show active py-4" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                <p class="mb-3">Recommended Use:</p>
                <ul class="list-disc">
                    <li class="my-2 ms-5">Please click "Submit Requests" once you have selected students you would like to move. This will submit ‘Yes’ students to <?php echo e(config('app.name')); ?> for review and move ‘Maybe’ and ‘No’ students to their respective tabs.</li>
                    <li class="my-2 ms-5">Connection emails to ‘Yes’ students will typically be sent within 24 hours, unless you would prefer to delay the emails. If you would prefer to delay your connection emails, please email <a href="mailto:bthomsen@meto-intl.org">bthomsen@meto-intl.org</a> or <a href="mailto:julie@meto-intl.org">julie@meto-intl.org</a>.</li>
                    <li class="my-2 ms-5">Please go <a href="<?php echo e(route('uni.mingrade')); ?>">here </a> to change your academic filter</li>
                    <li class="my-2 ms-5">Please go <a href="<?php echo e(route('uni.efc')); ?>">here</a> to change your EFC filter</li>
                </ul>
                <?php echo $__env->make('_partials.uni.students.pending', ['user' => $user, 'uni' => $uni], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane fade py-4" id="request-tab-pane" role="tabpanel" aria-labelledby="request-tab" tabindex="0">
                <p class="mb-3">Students will populate this tab once your connection emails have been sent. If you don’t see the students, please click Refresh. Please click Export to download an Excel sheet with this information.</p>
                <?php echo $__env->make('_partials.uni.students.request', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane fade py-4" id="maybe-tab-pane" role="tabpanel" aria-labelledby="maybe-tab" tabindex="0">
                <p class="mb-3">Please click Refresh to see all of the students you’ve marked as Maybe. To change a student’s status to Yes or No, please check the box next to the student, click Reset, and return to the To Review tab. Click Refresh on the To Review tab and you will see the student(s).</p>
                <?php echo $__env->make('_partials.uni.students.maybe', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane fade py-4" id="archived-tab-pane" role="tabpanel" aria-labelledby="archived-tab" tabindex="0">
                <p class="mb-3">Please click Refresh to see all of the students you’ve marked as No. To change a student’s status to Yes or Maybe, please check the box next to the student, click Reset, and return to the To Review tab. Click Refresh on the To Review tab and you will see the student(s).</p>
                <?php echo $__env->make('_partials.uni.students.archived', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>

        <div id="student-details-card-holder"></div>

        <?php $__env->startPush('js'); ?>
            <script src="<?php echo e(url('js/uni/students.js')); ?>"></script>
        <?php $__env->stopPush(); ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/uni/students.blade.php ENDPATH**/ ?>