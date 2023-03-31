@props(['name', 'help' => false, 'saved' => '', 'label' => ''])

<div class="my-4 bg-gray-100 px-4 py-3 rounded-md">
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 italic mb-4">{{ $help }}</div>
    @endif
    <div class="relative">
        <select id="{{ $name }}" name="{{ $name }}" class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm">
            <option value="">Select an option</option>
            @for ($i = 5.0; $i >= 0; $i -= 0.1)
                <?php $selected = (number_format($i, 1) == $saved) ? 'selected' : '' ?>
                <option value="{{ number_format($i, 1) }}" {{ $selected }}>{{ number_format($i, 1) }}</option>
            @endfor
        </select>
    </div>
</div>
    