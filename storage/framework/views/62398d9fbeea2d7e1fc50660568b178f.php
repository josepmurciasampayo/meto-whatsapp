<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="min-h-screen mt-5 mx-2 w-full">
    <h3 class="my-2 display-7">Raw Student Data</h3>

    <div class="my-3">
        <?php echo $__env->make('_partials.response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="table-container mb-5" style="height: 100vh; overflow-y: scroll;">
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr class="text-center">
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Date of Birth</th>
            <th>High School</th>
            <th>Country</th>
            <th>Matches</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><a target="_blank" href="<?php echo e(route('counselor-student', ['student_id' => $row['student_id']])); ?>"><?php echo $row['name'] ?></a></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><a href=""><?php echo $row['phone_raw'] ?></a></td>
            <td><?php echo $row['dob'] ?></td>
            <td><a href="<?php echo e(route('highschool', ['highschool_id' => $row['highschool_id']])); ?>"><?php echo $row['school'] ?></a></td>
            <td><?php echo '-' ?></td>
            <td class="text-center"><a href="<?php echo e(route('matches', ["id" => $row['student_id']])); ?>"><?php echo $row['matches'] ?></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dataTable','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dataTable'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
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
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/admin/students.blade.php ENDPATH**/ ?>