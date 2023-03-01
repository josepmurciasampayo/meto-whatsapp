@props(['checked' => '', 'options', 'name', 'help' => false, 'label', 'pickOne' => false])
<div class="mt-4">
    <fieldset>
        <legend>{{ $label }}</legend>
        @foreach ($options as $id => $option)
            <div>
                <input type="checkbox" id="{{ $name . '[' . $id . ']' }}" name="{{ $name . '[' . $id . ']' }}">
                <label for="{{ $name . '[' . $id . ']' }}">{{ $option }}</label>
            </div>
        @endforeach
    </fieldset>
    @if ($help)
        <div>{{ $help }}</div>
    @endif
</div>
