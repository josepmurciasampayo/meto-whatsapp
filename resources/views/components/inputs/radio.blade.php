<!-- radio.blade.php -->
@props(['options', 'name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false, 'wire'])

<fieldset>
    @php $required = ($req) ? '*' : '' @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif
    <div class="flex flex-col gap-2 bg-white p-2">
        @foreach ($options as $value => $option)
            @php $checked = ($value == $saved) ? 'checked' : '' @endphp
            @php $required = ($req) ? 'required' : '' @endphp
            <label class="inline-flex items-center" {{ $required }}>
                <input type="radio" class="form-radio h-4 w-4 text-green-600" {{ $required ? 'required' : null }} id="{{ $name . '[' . $value . ']' }}" name="{{ $name }}" value="{{ $value }}" @if(isset($wire)) wire:model="{{ $wire }}" @endif {{ $checked }}>
                <span class="ml-2 text-m">{{ $option }}</span>
            </label>
        @endforeach
    </div>
</fieldset>





