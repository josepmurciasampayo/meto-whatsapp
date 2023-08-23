<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['label' => '', 'name', 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false]) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['label' => '', 'name', 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false]); ?>
<?php foreach (array_filter((['label' => '', 'name', 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php $required = ($req) ? "*" : ""  ?>
<label for="<?php echo e($name); ?>" class="text-lg font-medium text-gray-800 mb-2"><?php echo $label ?? $slot; ?> <?php echo e($required); ?></label>

<?php if($help): ?>
    <div><?php echo e($help); ?></div>
<?php endif; ?>

<input value="<?php echo e($saved); ?>" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" <?php echo e($disabled ? 'disabled' : ''); ?> <?php echo e($required ? 'required' : null); ?> <?php echo $attributes->merge([
'class' => 'block h-10 w-full mb-6 rounded-md shadow-sm border border-gray-400 focus:border-blue-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 bg-green-100 text-green-800'
]); ?>>
<input type="hidden" id="lookupID" name="lookupID" value="">

<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $( "#<?php echo e($name); ?>" ).autocomplete({
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                    url:"<?php echo e(route('hsLookup')); ?>",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#<?php echo e($name); ?>').val(ui.item.label); // display the selected text
                $('#lookupID').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });
</script>
<?php /**PATH /Users/hbakouane/Desktop/valet/meto/resources/views/components/inputs/lookup-hs.blade.php ENDPATH**/ ?>