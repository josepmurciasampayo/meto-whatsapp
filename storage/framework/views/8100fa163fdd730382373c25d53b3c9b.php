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
    <div class="bg-gray-100 m-2 p-2">
      <h1 class="display-7 text-center">
      Welcome, <?php echo e(Auth::user()->first); ?>. You are a Counselor at <?php echo e($school->name); ?>.
  </h1>
  <p class="my-2 text-center">
      Actively Applying: <?php echo e($summaryCounts['active']); ?> of <?php echo e($summaryCounts['total']); ?> Total Students
  </p></div>
      
      
      <div class="flex justify-center" style="margin-top: 12px;margin-bottom: 12px;">
              <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-icon-main','data' => ['href' => ''.e(route('counselor-students', ['highschool_id' => $school->id] )).'','icon' => 'fa-solid fa-graduation-cap','text' => 'My students']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status-icon-main'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('counselor-students', ['highschool_id' => $school->id] )).'','icon' => 'fa-solid fa-graduation-cap','text' => 'My students']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
              <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-icon-main','data' => ['href' => ''.e(route('counselor-matches', ['highschool_id' => $school->id] )).'','icon' => 'fa-solid fa-handshake','text' => 'View Matches']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('status-icon-main'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('counselor-matches', ['highschool_id' => $school->id] )).'','icon' => 'fa-solid fa-handshake','text' => 'View Matches']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
          </div>
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
          <?php if (Auth()->user()->isSchoolAdmin()) { ?>
            <div class="flex justify-center gap-4" style="margin-top: 12px; margin-bottom: 12px;">
              <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-nav','data' => ['href' => ''.e(route('highschool', ['highschool_id' => $school->id])).'','class' => 'block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 px-3 py-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('highschool', ['highschool_id' => $school->id])).'','class' => 'block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 px-3 py-2']); ?>
                  <i class="fa-solid fa-school-flag"></i> Institution profile
               <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
              <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-nav','data' => ['href' => ''.e(route('invite', ['highschool_id' => $school->id])).'','class' => 'block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 px-3 py-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('invite', ['highschool_id' => $school->id])).'','class' => 'block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 px-3 py-2']); ?>
                  <i class="fa-solid fa-user-plus"></i> Invite new counselors
               <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
          </div>
          <?php } ?>
      </div>
  </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>

<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/counselor/home.blade.php ENDPATH**/ ?>