<button <?php echo e($attributes->merge([
   'type' => 'submit',
   'class' => 'btn btn-outline-success',
   'style' => '
        border-radius: 5px !important;
        transition-duration: .3s;
    '
   ])); ?>>
    <?php echo e($slot); ?>

</button>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/button-secondary.blade.php ENDPATH**/ ?>