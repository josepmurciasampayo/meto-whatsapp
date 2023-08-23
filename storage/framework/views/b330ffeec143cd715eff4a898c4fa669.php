<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <h3 class="text-center mt-5">Counselor Consent Form</h3>
    <br/>
    <p>
        <?php echo e(config('app.name')); ?> Incorporated is a non-profit organization with its offices at 724 F St NE, Washington, DC 20002 (EIN No: 84-2456429) ("<?php echo e(config('app.name')); ?>", “we”, “us” and “our”). Meto has developed an online “meeting place” (the “service”) that enables counselors (hereafter referred to as “you" and “your”) to create unique profiles in order to access and connect with students and educational institutions (hereafter referred to as “Educational Institutions").
    </p>
    <br/>
    <p>
        In order to provide you with the service, we need to process certain personal data (e.g., your name, email address, and professional history). We process such data in accordance with our Privacy Policy [insert link and remove these square brackets]. Meto is the data controller of your personal data processed in connection with the service.
    </p>
    <br/>
    <p>
        By clicking “I Agree” you confirm you have read and fully understood the terms set out in this consent form and that each of the following statements is true:
    </p>
    <ul>
        <li>You understand and agree that by creating a Meto profile and/or by making use of the service, we will use your personal data for the purpose of providing the service.</li>
        <li>You understand and agree that we will only share your personal data with third parties in connection with our provision of the service (e.g., Educational Institutions, students, and our suppliers or service providers).</li>
        <li>All of the information, including personal data, you have provided us is complete, true, and correct to the best of your knowledge.</li>
    </ul>
    <?php if(Auth::user() && !Auth::user()->consent()): ?>
        <form action="<?php echo e(route('saveConsent')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="consent" id="consent" value="<?php echo e(\App\Enums\General\YesNo::YES()); ?>">
            <div class="text-center mt-3">
                <?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>I Agree <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
            </div>
        </form>
    <?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/static/consent-counselor.blade.php ENDPATH**/ ?>