<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="w-75">
    <h3 class="text-center mt-5 display-7">Student Consent Form</h3>
    <br/><br/>
    <p>
        Meto, Inc. is a non-profit organization with its offices at 1802 Vernon Street NW PMB 2252, Washington, D.C. 20009 (EIN: 84-2456429) ("<strong>Meto</strong>", “<strong>we</strong>”, “<strong>us</strong>” and “<strong>our</strong>”).
        Meto has developed an online “meeting place” (the “<strong>service</strong>”) that enables students (hereafter referred to as “<strong>you</strong>" and “<strong>your</strong>”) to create unique profiles in order to access and connect with universities and other educational institutions (hereafter referred to as “<strong>Educational Institutions</strong>").
    </p>
    <br/><br/>
    <p>
        In order to provide you with the service, we need to process certain personal data (for example, your name, email address, educational history, etc.). We process such data in accordance with our <a href="<?php echo e(route('privacy')); ?>">Student Privacy Policy</a>. Meto is the data controller of your personal data processed in connection with the service.
    </p>
    <br/>
    <p>
        By clicking “yes,” you confirm that you have read and fully understood the terms set out in this consent form and that each of the following statements are true:
    </p>
    <ul class="list-disc ms-5">
        <strong>
        <li>You understand and agree that by creating a Meto profile and/or by making use of the service, we will use your personal data for the purpose of providing the service.</li>
        <li>You understand and agree that we will only share your personal data with third parties in connection with our provision of the service (e.g., Educational Institutions and our suppliers or service providers). </li>
        <li>All of the information, including personal data, you have provided us is complete, true and correct to the best of your knowledge.</li>
        </strong>
    </ul>
    <br/>
    <p>
        If you do not agree to these terms, please do not use the service.
    </p>
    <br/>
    <p class="fw-bold">PARENTAL CONSENT (UNDER 16)</p>
    <p>
        For students aged 15 or below, or students unable to consent for other reasons, your parent or legal guardian must provide their consent to the terms above. By proceeding, you acknowledge that your parent or legal guardian has reviewed these terms and has provided their consent or authorization.
    </p>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/static/consent-student.blade.php ENDPATH**/ ?>