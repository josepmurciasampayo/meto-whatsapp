@props(['options', 'name', 'saved' => '', 'label' => ''])
<div class="my-4">
    <label for="{{ $name }}">{{ $label }}</label>
    <select id="{{ $name }}" name="{{ $name }}" label="{{ $label }}" value="{{ $saved }}">
        <?php foreach ($options as $index => $value) { ?>
        <?php $selected = ($index == $saved) ? 'selected' : '' ?>
        <option value="{{ $index }}" {{ $selected }}>{{ $value }}</option>
        <?php } ?>
    </select>
    @if ($question->help)
        <div>{{ $question->help }}</div>
    @endif
</div>
