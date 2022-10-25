@props(['value'])
<label class='block font-medium text-sm text-gray-700'>
    <?php echo $value ?? $slot ?>
</label>
