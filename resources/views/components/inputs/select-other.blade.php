<x-select> </x-select>
    <div class="mt-2" id="{{ $name }}-other" style="{{ $saved === 'other' ? 'display: block;' : 'display: none;' }}">
        <input type="text" name="{{ $name }}_other" id="{{ $name }}_other" class="block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" placeholder="Please specify" value="{{ $saved === 'other' ? old($name.'_other') : '' }}">
    </div>
</div>

@push('scripts')
<script>
    function toggleOtherInput(selectElement) {
        const otherInput = document.getElementById(selectElement.id + '-other');
        if (selectElement.value === 'other') {
            otherInput.style.display = 'block';
        } else {
            otherInput.style.display = 'none';
        }
    }
</script>
@endpush
