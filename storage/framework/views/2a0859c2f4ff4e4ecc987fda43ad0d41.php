<!--
  | @var StudentUniversity $studentUniversity
-->

<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => $__env->getContainer()->make(Illuminate\View\Factory::class)->make('mail::message'),'data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('mail::message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
Dear <?php echo e($studentUniversity->student->user->first); ?>,

Greetings from <?php echo e(config('app.name')); ?>. <?php echo e($studentUniversity->institution->name); ?> has reviewed your profile and they have determined you are a competitive candidate for admission and would like to invite you to apply.

It is my pleasure to introduce you to <?php echo e($studentUniversity->requester->getFullName()); ?>, the <?php echo e($studentUniversity->requester->title); ?>. To contact <?php echo e($studentUniversity->requester->first); ?>, please email <a href="mailto:<?php echo e($studentUniversity->requester->email); ?>"><?php echo e($studentUniversity->requester->email); ?></a>.

Here is what you need to know to get started.

Application link:
    <a href="<?php echo e($studentUniversity->application_link); ?>"><?php echo e($studentUniversity->application_link); ?></a>

Application deadline: <?php echo e(\Carbon\Carbon::parse($studentUniversity->deadline)->format('M d, Y')); ?>


Thank you,<br>
<?php echo e(config('app.name')); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/connections/connection_was_approved.blade.php ENDPATH**/ ?>