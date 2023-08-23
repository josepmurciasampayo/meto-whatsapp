<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="p-6 bg-white border-b border-gray-200">
        <i class="fas fa-home"></i> Welcome, <?php echo Auth::user()->first ?>. You are an Administrator.
    </div>
    <div class="p-6" class="mb-16"> 
        <div>  
        <p class="h3" style="color:green">New High School or Access Program Request</p>  <br>    
        <iframe style="width: 40em; border: 1px solid" src="https://docs.google.com/forms/d/e/1FAIpQLSf0lH1aJamBv6lp5B4C2hFDRG9NmY-ctCxLT6BmHVx0e4MmmA/viewform?embedded=true" width="700" height="520" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
        </div> <br>
        <div>
        <p class="h3" style="color:green">Issue Log</p> <br>
        <iframe style="width: 40em; border: 1px solid" src="https://docs.google.com/forms/d/e/1FAIpQLSfwK_AaezRDLFmkNwsAU7v8Zx9u1DiEswOAcrsRJ-VGFy7CzQ/viewform?embedded=true" width="640" height="770" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
        </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/admin/workRequest.blade.php ENDPATH**/ ?>