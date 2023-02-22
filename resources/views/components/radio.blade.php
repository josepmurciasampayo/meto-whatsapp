@props(['options', 'name', 'saved' => '', 'label' => ''])
<fieldset>
    <legend>{{ $label }}</legend>
    @foreach ($options as $option)
        <?php $id = $option['id'] ?>
        <?php $text = $option['text'] ?>
        <?php $checked = ($text == $saved) ? 'checked' : '' ?>
    <div>
        <input type="radio" id="{{ $name . '[' . $id . ']' }}" name="{{ $name }}" value="{{ $text }}" {{ $checked }}>
        <label for="{{ $name . '[' . $id . ']' }}">{{ $text }}</label>
    </div>
    @endforeach
</fieldset>
