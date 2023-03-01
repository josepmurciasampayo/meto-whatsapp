@props(['options', 'name', 'help' => false, 'saved' => '', 'label' => ''])
<fieldset>
    <legend>{{ $label }}</legend>
    @foreach ($options as $value => $option)
            <?php $checked = ($value == $saved) ? 'checked' : '' ?>
        <div>
            <input type="radio" id="{{ $name . '[' . $value . ']' }}" name="{{ $name }}" value="{{ $option }}" {{ $checked }}>
            <label for="{{ $name . '[' . $value . ']' }}">{{ $option }}</label>
        </div>
    @endforeach
    @if ($help)
        <div>{{ $help }}</div>
    @endif
</fieldset>
