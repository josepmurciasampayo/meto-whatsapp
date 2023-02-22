@props(['options', 'name', 'saved' => '', 'label' => ''])
<div class="my-4">
    <label for="{{ $name }}">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" label="{{ $label }}" value="{{ $saved }}">
        <?php foreach ($options as $option) { ?>
        <?php $selected = ($option['id'] == $saved) ? 'selected' : '' ?>
        <option value="{{ $option['id'] }}" {{ $selected }}>{{ $option['text'] }}</option>
        <?php } ?>
    </select>
</div>
