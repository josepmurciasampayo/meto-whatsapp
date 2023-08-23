<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title'); ?></title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=proza-libre:400,600,800" rel="stylesheet" />
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/app.css" type="text/css">
    <link rel="stylesheet/less" type="text/css" href="/css/public.css?v=2" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tom-select/2.2.2/css/tom-select.bootstrap5.min.css">

    <!-- Livewire -->
    <?php echo \Livewire\Livewire::styles(); ?>


    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.6.1.slim.min.js"></script>
    <script src="/js/lodash.core.min.js"></script>
    <script src="/js/instantpage-5.1.1.js" type="module"></script>

    <script src="https://kit.fontawesome.com/c239959cd5.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="module" defer>
        import Alpine from "https://cdn.jsdelivr.net/npm/alpinejs@3.12.2/+esm";
        // import TomSelect from "https://cdn.jsdelivr.net/npm/tom-select@2.2.2/+esm";
        import pgTomSelect from "<?php echo e(url('vendor/power-components/livewire-powergrid/resources/js/components/select/tomSelect.js')); ?>";

        window.Alpine = Alpine

        // window.Alpine.data('pgTomSelect', new pgTomSelect('select[multiple]'));
        window.Alpine.data('pgTomSelect', pgTomSelect);

        Alpine.start()
    </script>

    <!-- LESS -->
    <script src="https://cdn.jsdelivr.net/npm/less"></script>

    <!-- Bootstrap date picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script type="text/javascript">
        function validateAndSubmit() {
            let message = "";
            let hasError = false;
            (Array.from(document.forms[0].elements)).forEach(element => {
                if (element.required && !element.hidden && element.value === "") {
                    hasError = true;
                    message = "Please fill out all required fields";
                }
            });
            if (document.getElementById('email') && document.getElementById('password')) {
                if (document.getElementById('email').value !== document.getElementById('email_confirmation').value) {
                    hasError = true;
                    message += (message.length == 0) ? "Email addresses do not match" : "\nEmail addresses do not match";
                }
                if (document.getElementById('password').value !== document.getElementById('password_confirmation').value) {
                    hasError = true;
                    message += (message.length == 0) ? "Passwords do not match" : "\nPasswords do not match";
                }
            }
            if ($('.checkboxes-consent :checkbox').length - $('.checkboxes-consent :checkbox:checked').length !== 0) {
                hasError = true;
                message =+ (message.length == 0) ? "Please review the terms and privacy policy" : "\nPlease review the terms and privacy policy";
            }
            if (hasError) {
                alert(message);
                return;
            }
            document.forms[0].submit();
        }
    </script>

</head>

<body class="font-sans antialiased">
    <header style="background-color: rgb(5,23,21); color: white; min-height: 80px; height: 80px;" class="min-h-screen">
        <div class="p-6 d-flex justify-content-between">
            <div>
                <a href="<?php echo e(route('home')); ?>"><img src="/img/meto-logo.webp" style="height: 36px;"></a>
            </div>

            <div>
                <?php if(Auth()->user()): ?>
                    <?php if(!(Auth()->user()->isStudent())): ?>
                        <a class="text-white mx-3" style="text-decoration: none;" href="<?php echo e(route('profile')); ?>">Profile</a>
                   <?php endif; ?>
                    <a class="text-white mx-3" style="text-decoration: none;" href="<?php echo e(route('logout')); ?>">Logout</a>
                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button-nav','data' => ['href' => ''.e(route('signup')).'','class' => 'btn btn-outline text-white-600 hover:text-gray-900 text-xs']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('signup')).'','class' => 'btn btn-outline text-white-600 hover:text-gray-900 text-xs']); ?><i class="fas fa-user-plus"></i> Create an Account <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <?php if(Auth()->user()?->isAdmin()): ?>
            <div class="flex">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.sidebar-menu','data' => ['links' => [
                    ['label' => 'Questions', 'icon' => 'fas fa-question', 'href' => route('questions.index')],
                    ['label' => 'Curricula', 'icon' => 'fas fa-book', 'href' => route('curriculum.index')],
                    ['label' => 'Students', 'icon' => 'fas fa-user', 'href' => route('students')],
                    ['label' => 'Connections', 'icon' => 'fas fa-handshake', 'href' => route('connections.index')],
                    ['label' => 'Universities', 'icon' => 'fas fa-building', 'href' => route('universities')],
                    ['label' => 'High Schools & Programs', 'icon' => 'fas fa-school', 'href' => route('highschools')],
                    ['label' => 'Reports', 'icon' => 'fas fa-chart-bar', 'href' => route('reports'), 'target' => '_blank'],
                    ['label' => 'Work Requests', 'icon' => 'fas fa-network-wired', 'href' => route('workRequest'), 'target' => '_blank'],
                ]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('sidebar-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['links' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                    ['label' => 'Questions', 'icon' => 'fas fa-question', 'href' => route('questions.index')],
                    ['label' => 'Curricula', 'icon' => 'fas fa-book', 'href' => route('curriculum.index')],
                    ['label' => 'Students', 'icon' => 'fas fa-user', 'href' => route('students')],
                    ['label' => 'Connections', 'icon' => 'fas fa-handshake', 'href' => route('connections.index')],
                    ['label' => 'Universities', 'icon' => 'fas fa-building', 'href' => route('universities')],
                    ['label' => 'High Schools & Programs', 'icon' => 'fas fa-school', 'href' => route('highschools')],
                    ['label' => 'Reports', 'icon' => 'fas fa-chart-bar', 'href' => route('reports'), 'target' => '_blank'],
                    ['label' => 'Work Requests', 'icon' => 'fas fa-network-wired', 'href' => route('workRequest'), 'target' => '_blank'],
                ])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>
    </header>

    <main class="container-fluid">
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <?php echo e($slot); ?>

            </div>
        </div>
    </main>

    <footer class="py-3 my-4 bg-black">
        <ul class="nav justify-content-center pb-3 mb-3">
            <?php if(is_null(Auth::user())): ?>
                <li><a href="<?php echo e(route('privacy')); ?>" class="nav-link text-white mx-3">Privacy Policy</a></li>
            <?php elseif(Auth::user()?->isStudent()): ?>
                <li><a href="<?php echo e(route('privacy')); ?>" class="nav-link text-white mx-3">Privacy Policy</a></li>
                <li><a href="<?php echo e(route('consent')); ?>" class="nav-link text-white mx-3">Consent Form</a></li>
            <?php elseif(Auth::user()->isInstitution()): ?>
                <li><a href="<?php echo e(route('privacy')); ?>" class="nav-link text-white mx-3">Privacy Policy</a></li>
                <li><a href="<?php echo e(route('consent')); ?>" class="nav-link text-white mx-3">Terms of Use</a></li>
            <?php elseif(Auth::user()->isCounselor()): ?>
                <li><a href="<?php echo e(route('privacy')); ?>" class="nav-link text-white mx-3">Privacy Policy</a></li>
                <li><a href="<?php echo e(route('terms')); ?>" class="nav-link text-white mx-3">Terms of Use</a></li>
            <?php endif; ?>
            <li><a href="<?php echo e(route('contact')); ?>" class="nav-link text-white mx-3">Contact Us</a></li>
        </ul>
    </footer>

    <?php echo \Livewire\Livewire::scripts(); ?>


    <!-- Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <?php echo $__env->yieldPushContent('js'); ?>
</body>
</html>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/layouts/app.blade.php ENDPATH**/ ?>