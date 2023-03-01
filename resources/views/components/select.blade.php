@props(['options', 'name', 'help' => false, 'saved' => '', 'label' => ''])
<div class="my-4">
    <label for="{{ $name }}">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" label="{{ $label }}" value="{{ $saved }}">
        <?php foreach ($options as $index => $value) { ?>
        <?php $selected = ($index == $saved) ? 'selected' : '' ?>
        <option value="{{ $index }}" {{ $selected }}>{{ $value }}</option>
        <?php } ?>
    </select>
    @if ($help)
        <div>{{ $help }}</div>
    @endif
</div>
