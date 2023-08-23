<?php if(session()->has('response')): ?>
    <div class="alert alert-success">
        <strong>
            <?php echo e(session()->get('response')); ?>

        </strong>
    </div>
<?php endif; ?>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/_partials/response.blade.php ENDPATH**/ ?>