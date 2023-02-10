@props(['label', 'name', 'disabled' => false])
<label for="{{ $name }}" class='block font-medium text-sm text-gray-700'>
    <?php echo $label ?? $slot ?>
</label>
<input name="{{ $name }}" id="{{ $name }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
   'class' => 'block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
   ]) !!}>
