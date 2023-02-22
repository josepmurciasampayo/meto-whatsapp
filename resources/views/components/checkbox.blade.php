@props(['checked' => '', 'options', 'name', 'label', 'pickOne' => false])
<div class="mt-4">
    <fieldset>
        <legend>{{ $label }}</legend>
        @foreach ($options as $option)
            <div>
                <input type="checkbox" id="{{ $name . '[' . $option['id'] . ']' }}" name="{{ $name . '[' . $option['id'] . ']' }}">
                <label for="{{ $name . '[' . $option['id'] . ']' }}">{{ $option['text'] }}</label>
            </div>
        @endforeach
    </fieldset>
</div>
