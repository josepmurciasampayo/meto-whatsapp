<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="min-h-screen mt-5 mx-2">
    <?php if (isset($component)) { $__componentOriginal72223c1f24bd75f26e42431424409587 = $component; } ?>
<?php $component = App\View\Components\NotesCounselor::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('notes-counselor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\NotesCounselor::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['notes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($notes)]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal72223c1f24bd75f26e42431424409587)): ?>
<?php $component = $__componentOriginal72223c1f24bd75f26e42431424409587; ?>
<?php unset($__componentOriginal72223c1f24bd75f26e42431424409587); ?>
<?php endif; ?>
    <h1 class="display-7 my-5">Outcome Data Summary</h1>
    <div class="table-container mb-5" style="height: 400px; overflow-y: scroll;">
    <table id="summary" class="table table-striped bg-white">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actively Applying</th>
            <th>Matched</th>
            <th>Not Interested</th>
            <th>Applied</th>
            <th>Accepted</th>
            <th>Denied</th>
            <th>Enrolled</th>
            <th>Waitlisted</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Name</th>
            <th>Actively Applying</th>
            <th>Matched</th>
            <th>Not Interested</th>
            <th>Applied</th>
            <th>Accepted</th>
            <th>Denied</th>
            <th>Enrolled</th>
            <th>Waitlisted</th>
        </tr>
        </tfoot>

        <tbody>
        
        <?php foreach ($summary as $row) { ?>
        <tr>
            <td><a class="my-link" href="<?php echo e(route('counselor-student', ['student_id' => $row['student_id']])); ?>"><?php echo e($row['name']); ?></a></td>
            <td><?php echo e($row['active']); ?></td>
            <td><?php echo e($row[\App\Enums\General\MatchStudentInstitution::UNKNOWN()]); ?></td>
            <td><?php echo e($row[\App\Enums\General\MatchStudentInstitution::NOTINTERESTED()]); ?></td>
            <td><?php echo e($row[\App\Enums\General\MatchStudentInstitution::APPLIED()]); ?></td>
            <td><?php echo e($row[\App\Enums\General\MatchStudentInstitution::ACCEPTED()]); ?></td>
            <td><?php echo e($row[\App\Enums\General\MatchStudentInstitution::DENIED()]); ?></td>
            <td><?php echo e($row[\App\Enums\General\MatchStudentInstitution::ENROLLED()]); ?></td>
            <td><?php echo e($row[\App\Enums\General\MatchStudentInstitution::WAITLISTED()]); ?></td>
        </tr>
        <?php } ?>
        </tbody>
    
    </table>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dataTable','data' => ['name' => 'summary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dataTable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'summary']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>


</div>

<h1 class="display-7 my-5">Match Data Summary</h1>

    <div class="table-container mb-5" style="height: 400px; overflow-y: scroll;">

   

    <table id="data" class="table table-striped bg-white">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Institution</th>
            <th>Status</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Institution</th>
            <th>Status</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><a class="my-link" href="<?php echo e(route('counselor-student', ['student_id' => $row['student_id']])); ?>"><?php echo $row['name'] ?></a></td>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['institution_name'] ?></td>
            <td><?php echo $row['status'] ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dataTable','data' => ['name' => 'data']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dataTable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'data']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
    
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/counselor/matches.blade.php ENDPATH**/ ?>