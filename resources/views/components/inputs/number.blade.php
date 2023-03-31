@props(['label' => 'Number', 'name' => 'phone', 'help' => false, 'saved' => ''])


<div class="my-4 bg-gray-100 rounded-md p-4">
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif
    <div class="flex flex-wrap items-center">
    
        <input type="tel" name="{{ $name }}_number" id="{{ $name }}_number" placeholder="" class="mt-2 sm:mt-0 flex-1 ml-0 sm:ml-2 block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" pattern="\d{0,10}" maxlength="10" oninput="this.value = this.value.replace(/\D/g, '')">
    </div>
    <input type="hidden" name="{{ $name }}" id="{{ $name }}">
</div>


@push('scripts')
    <script>
        const codeSelect = document.getElementById('{{ $name }}_code');
        const numberInput = document.getElementById('{{ $name }}_number');
        const hiddenInput = document.getElementById('{{ $name }}');
        
        // update the hidden input value when the code or number input changes
        const updateHiddenValue = () => {
            hiddenInput.value = codeSelect.value + ' ' + numberInput.value.replace(/[^0-9]/g, '');
        };
        
        codeSelect.addEventListener('change', updateHiddenValue);
        numberInput.addEventListener('input', updateHiddenValue);
    </script>
@endpush
