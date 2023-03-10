@props(['options', 'name', 'help' => false, 'saved' => '', 'label' => ''])

<fieldset class="my-4 bg-gray-100 p-4 rounded-md">
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif
    <div class="flex flex-col gap-2">
        @foreach ($options as $value => $option)
            <?php $checked = ($option == $saved) ? 'checked' : '' ?>
            <label class="inline-flex items-center">
                <input type="radio" class="form-radio h-4 w-4 text-green-600" id="{{ $name . '[' . $value . ']' }}" name="{{ $name }}" value="{{ $option }}" {{ $checked }}>
                <span class="ml-2 text-sm">{{ $option }}</span>
            </label>
        @endforeach
    </div>
</fieldset>





