New connection requests from <?php echo e($uni->name); ?>:
<br /><br />
<?php $__currentLoopData = $createdConnections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $connection): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo e($connection['student']['user']['first'] . ' ' . $connection['student']['user']['last']); ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<br/><br/>
Please review and approve <a href="<?php echo e(route('connections.index')); ?>">here</a>.
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/connections/send_request.blade.php ENDPATH**/ ?>