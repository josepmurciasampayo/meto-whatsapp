<button <?php echo e($attributes->merge([
   'type' => 'submit',
   'class' => 'btn button-state-styles',
   'style' => '
        border-radius: 5px !important;
        color: rgb(22, 66, 22) !important;
        background-color: rgb(22, 66, 22) !important;
        border-color: ivory !important;
        color: white !important;
        transition-duration: .3s;
        :hover {
            color: black !important;
        }
    '
   ])); ?>>
    <?php echo e($slot); ?>

</button>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/button.blade.php ENDPATH**/ ?>