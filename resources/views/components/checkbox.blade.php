@props(['saved' => '', 'options', 'name', 'help' => false, 'label', 'pickOne' => false])
<div class="mt-4">
    <fieldset>
        <legend>{{ $label }}</legend>
        @foreach ($options as $id => $option)
            @php $checked = (in_array($id, $saved)) ? 'checked' : '' @endphp
            <div>
                <input type="checkbox" id="{{ $name . '[' . $id . ']' }}" name="{{ $name . '[' . $id . ']' }}" {{ $checked }}>
                <label for="{{ $name . '[' . $id . ']' }}">{{ $option }}</label>
            </div>
        @endforeach
    </fieldset>
    @if ($help)
        <div>{{ $help }}</div>
    @endif
</div>
