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
    <form method="POST" action="<?php echo e(route('remove', ['student_id' => $student_id])); ?>">
        <?php echo csrf_field(); ?>
     <div class="my-4"><?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit']); ?><i class="fas fa-trash-alt"></i> Remove Student <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?></div>


    </form>
    <h2 class="my-2 display-7">Matches: <?php echo e($data[0]['name']); ?></h2>
    <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-nav','data' => ['href' => '#raw','class' => 'block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 px-3 py-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => '#raw','class' => 'block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 px-3 py-2']); ?>
        <i class="fa fa-arrow-down"></i> Jump to Summary Data <i class="fas fa-chart-pie"></i>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>

    <form class="mb-2" id="submitMatches" method="POST" action="<?php echo e(route('saveStudentMatches')); ?>">
        <?php echo csrf_field(); ?>
        <input type="hidden" id="student_id" name="student_id" value="<?php echo e($student_id); ?>">

        <div class="table-container" style="height: 400px; overflow-y: scroll;">

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
        <table id="matches" class="table bg-white ">
            <thead>
                <tr>
                    <th>University</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($matches as $match) {?>
                    <tr>
                        <td><?php echo e($match['name']); ?></td>
                        <td>
                            <select id="match-<?php echo e($match['match_id']); ?>" name="match-<?php echo e($match['match_id']); ?>">
                                <?php foreach ($matchStatuses as $status_id => $status) { ?>
                                <?php echo e($selected = ($match['status'] == $status) ? 'selected' : ''); ?>

                                <option value="<?php echo e($status_id); ?>" <?php echo e($selected); ?>><?php echo e($status); ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
    </form>

    <div class="d-flex">
        <div class="col">
            <form method="POST" action="<?php echo e(route('admin.student.delete', request('student_id'))); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger rounded-5">Delete</button>
            </form>
        </div>
        <div class="col text-end">
            <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Submit Updates <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        </div>
    </div>

    <h2 id="raw" class="my-2 display-7">Summary Data: <?php echo e($data[0]['name']); ?></h2>
    <div class="bg-gray-100 p-4 rounded-lg shadow-lg my-5">
      <?php foreach ($data as $row) { ?>
        <div class="py-4 border-b border-gray-300">
          <div class="row">
            <div class="col-md-3">
              <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.label','data' => ['value' => ''.e($row['question']).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['value' => ''.e($row['question']).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </div>
            <div class="col-md-9">
              <p><?php echo $row['answer'] ?></p>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
    <form id="verify" name="verify" action="<?php echo e(route('saveVerify')); ?>" method="POST">

      <?php echo csrf_field(); ?>

      <input type="hidden" name="student_id" id="student-id" value="<?php echo e($student_id); ?>">

      <?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
        <div class="my-4">
          <div class="row">
            <div class="col-md-3">
              <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.label','data' => ['for' => 'verify','value' => 'Data Verification']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'verify','value' => 'Data Verification']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
              <p class="text-xs">Is the data submitted accurate?.

            </div>
            <div class="col-md-9">
              <div class="btn-group" role="group" aria-label="Data verification">
                <?php $on_checked = ($data[0]['verify'] == 1) ? "checked" : ""; ?>
                <?php $off_checked = ($data[0]['verify'] == 0) ? "checked" : ""; ?>
                <input type="radio" class="btn-check" name="verify" id="verify_on" autocomplete="off" <?php echo e($on_checked); ?>>
                <label class="btn btn-outline-success" for="verify_on">Verified</label>

                <input type="radio" class="btn-check" name="verify" id="verify_off" autocomplete="off" <?php echo e($off_checked); ?>>
                <label class="btn btn-outline-success" for="verify_off">Not Verified Yet</label>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

      <?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
        <div class="my-4">
          <div class="row">
            <div class="col-md-3">
              <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.label','data' => ['for' => 'notes','value' => 'Notes']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'notes','value' => 'Notes']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
              <p class="text-xs">Add notes for corrections. <?php echo e(config('app.name')); ?> staff can view them.
            </p>
            </div>
            <div class="col-md-9">
              <textarea class="form-control" id="verify_notes" name="verify_notes" rows="4"><?php echo e($data[0]['verify_notes']); ?></textarea>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div class="my-4">
          <div class="row">
            <div class="col-md-3">
              <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.label','data' => ['for' => 'notes','value' => 'Counselor notes']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'notes','value' => 'Counselor notes']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </div>
            <div class="col-md-9">
              <textarea class="form-control" id="verify_notes" name="verify_notes" rows="4" disabled><?php echo e($data[0]['verify_notes']); ?></textarea>
            </div>
          </div>
        </div>
      <?php } ?>

      <?php if (Auth()->user()->role == \App\Enums\User\Role::COUNSELOR()) { ?>
        <div class="text-end p-3">
          <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Submit Request to <?php echo e(config('app.name')); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
        </div>
      <?php } ?>


 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/counselor/student.blade.php ENDPATH**/ ?>