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
        <h1 class="display-7 my-5">High Schools & Access Programs</h1>
        <div class="table-container mb-5" style="height: 100vh; overflow-y: scroll;">
    <table id="dataTable" class="table table-striped bg-white">
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
        <thead>
        <tr>
            <th>Selected</th>
            <th>Verified</th>
            <th>High School</th>
            <th>Curriculum</th>
            <th>Country</th>
            <th>Students</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>-</th>
            <th>Verified</th>
            <th>High School</th>
            <th>Curriculum</th>
            <th>Country</th>
            <th>Students</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td class="text-center"><input class="listen" id="<?php echo e($row['id']); ?>" value="<?php echo e($row['id']); ?>" type="checkbox"></td>
            <td class="text-center"><input id="<?php echo e($row['id']); ?>" <?php echo e(($row['verified'] == \App\Enums\General\YesNo::YES()) ? "checked" : ""); ?> type="checkbox"></td>
            <td><a class="my-link" href="<?php echo e(route('highschool', ['highschool_id' => $row['id']])); ?>"><?php echo $row['name'] ?></a></td>
            <td><?php echo $row['curriculum'] ?></td>
            <td><?php echo $row['country'] ?></td>
            <td class="text-center"><a href="<?php echo e(route('students', ['highschool_id' => $row['id']])); ?>"><?php echo $row['students'] ?></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    
</div>
    <form method="POST" action="<?php echo e(route('mergeHS')); ?>">
        <input type="hidden" name="IDs" id="IDs" value="">
        <input type="hidden" name="verifyIDs" id="verifyIDs" value="">
        <?php echo csrf_field(); ?>
        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><i class="fas fa-code-branch"></i> Merge <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit']); ?><i class="fas fa-user-check"></i> Verify <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        
    </form>
    <script type="text/javascript">
        var countHS = new Set();
        var verifiedHS = new Set();


        addEventListener('input', (event) => {
            if (event.target.type === "checkbox") {
                if (event.target.classList.contains("listen")) {
                    if (event.target.checked) {
                        countHS.add(event.target.id);
                    } else {
                        countHS.remove(event.target.id);
                    }
                    document.getElementById('IDs').value = Array.from(countHS).join(',');
                } else {
                    if (event.target.checked) {
                        verifiedHS.add(event.target.id);
                    } else {
                        verifiedHS.remove(event.target.id);
                    }
                    document.getElementById('verifyIDs').value = Array.from(verifiedHS).join(',');
                }
            }
        })
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/admin/highschools.blade.php ENDPATH**/ ?>