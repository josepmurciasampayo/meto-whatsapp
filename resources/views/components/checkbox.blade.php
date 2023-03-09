@props(['saved' => '', 'options', 'name', 'help' => false, 'label', 'pickOne' => false])

<div class="my-4 bg-gray-100 rounded-md p-4">
    <fieldset class="flex flex-col gap-2">
        <legend class="text-lg font-medium text-gray-800 mb-2">{{ $label }}</legend>
        @if ($help)
        <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
        @endif
        @foreach ($options as $id => $option)
            @php $checked = (in_array($id, $saved)) ? 'checked' : '' @endphp
            <label class="inline-flex items-center">
                <input type="checkbox" class="form-checkbox h-4 w-4 text-green-600" id="{{ $name . '[' . $id . ']' }}" name="{{ $name . '[' . $id . ']' }}" {{ $checked }}>
                <span class="ml-2 text-sm">{{ $option }}</span>
            </label>
            @if ($pickOne)
                @break
            @endif
        @endforeach
    </fieldset>
</div>