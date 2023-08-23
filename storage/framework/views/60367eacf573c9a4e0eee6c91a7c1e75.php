<?php $__env->startSection('title', __('Page Not Found')); ?>
<?php $__env->startSection('code', '404'); ?>
<?php $__env->startSection('message', __($exception->getMessage() ?: 'Page Not Found')); ?>

<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/errors/404.blade.php ENDPATH**/ ?>