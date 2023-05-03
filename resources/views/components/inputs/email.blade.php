<!-- resources/views/components/email.blade.php -->
@props(['label' => '', 'name', 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false])

<div class="my-4 bg-gray-100 rounded-md p-4">
    @php $required = ($req) ? "*" : ""  @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>

    @if ($help)
        <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif

    @php $required = ($req) ? "required" : "" @endphp
    <input value="{{ $saved }}" name="{{ $name }}" id="{{ $name }}" type="email" inputmode="email" pattern="[^@]+@[^@]+\.[^@]{2,}" {{ $disabled ? 'disabled' : '' }} class="block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" {{ $required }}>
    <div class="text-sm text-red-600 mt-1 hidden" id="{{ $name }}_error">Please enter a valid email address.</div>
</div>

@push('scripts')
<script>
    document.getElementById('{{ $name }}').addEventListener('input', function (event) {
        const errorDiv = document.getElementById('{{ $name }}_error');
        if (!event.target.validity.valid) {
            errorDiv.classList.remove('hidden');
        } else {
            errorDiv.classList.add('hidden');
        }
    });
</script>
@endpush
