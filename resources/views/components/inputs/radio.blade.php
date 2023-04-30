@props(['options', 'name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false])

<fieldset class="my-4 bg-gray-100 p-4 rounded-md">
    @php $required = ($req) ? '*' : '' @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif
    <div class="flex flex-col gap-2 bg-white p-2">
        @foreach ($options as $value => $option)
            @php $checked = ($option == $saved) ? 'checked' : '' @endphp
            @php $required = ($req) ? 'required' : '' @endphp
            <label class="inline-flex items-center" {{ $required }}>
                <input type="radio" class="form-radio h-4 w-4 text-green-600" id="{{ $name . '[' . $value . ']' }}" name="{{ $name }}" value="{{ $value }}" {{ $checked }}>
                <span class="ml-2 text-m">{{ $option }}</span>
            </label>
        @endforeach
    </div>
</fieldset>





