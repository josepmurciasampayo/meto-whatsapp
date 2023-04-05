@props(['label', 'name', 'help' => false, 'saved' => '', 'disabled' => false])

<div class="my-4 p-4 bg-gray-100 rounded-md">
    <label for="{{ $name }}" class="block text-lg font-medium text-gray-800 mb-2">{{ $label }}</label>
    @if ($help)
    <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif
    <textarea id="{{ $name }}" name="{{ $name }}" rows="4" class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focusring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" {{ $disabled ? 'disabled' : '' }}>{{ $saved }}</textarea>
</div>
