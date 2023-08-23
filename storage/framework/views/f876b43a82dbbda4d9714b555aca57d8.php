<?php $__env->startSection('title', __('Forbidden')); ?>
<?php $__env->startSection('code', '403'); ?>
<?php $__env->startSection('message', __($exception->getMessage() ?: 'Forbidden. You do not have permission to access this page. Please check your credentials or contact the administrator.')); ?>

<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/errors/403.blade.php ENDPATH**/ ?>