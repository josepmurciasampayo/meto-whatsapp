@props(['saved' => array(), 'options', 'name', 'help' => false, 'label', 'pickOne' => false, 'req' => false])

<fieldset class="flex flex-col gap-2">
    @php $required = ($req) ? '*' : '' @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
    @if ($help)
    <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif

    @foreach ($options as $id => $option)
        @php $checked = (in_array($id, $saved)) ? 'checked' : '' @endphp
        <label class="inline-flex items-center">
            @php $required = ($req) ? 'required' : '' @endphp
            <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600" id="{{ $name . '[' . $id . ']' }}" name="{{ $name . '[' . $id . ']' }}" {{ $checked }} {{ $required }}>
            <span class="ml-2 text-sm">{!! $option !!}</span>
        </label>
        @if ($pickOne)
            @break
        @endif
    @endforeach

</fieldset>

