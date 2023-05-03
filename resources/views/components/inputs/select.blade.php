<!-- select.blade.php -->
@props(['options', 'name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false])

<div class="my-4 bg-gray-100 px-4 py-3 rounded-md">
    @php $required = ($req) ? "*" : ""  @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 italic mb-4">{{ $help }}</div>
    @endif
    <div class="relative">
        @php $required = ($req) ? "required" : ""  @endphp
        <select id="{{ $name }}" {{ $required }} name="{{ $name }}" class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm">
            <option value="">Select an option</option>

            @foreach ($options as $index => $value)
                @php $selected = ($index == ($saved)) ? 'selected' : '' @endphp
                <option value="{{ $index }}" {{ $selected }}>{!! $value !!}</option>
            @endforeach

        </select>
        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none"></div>
    </div>
</div>
