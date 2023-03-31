<!-- date-input.blade.php -->
@props(['name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false])

<div class="my-4 bg-gray-100 px-4 py-3 rounded-md">
    @php $required = ($req == \App\Enums\General\YesNo::YES()) ? "*" : ""  @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 italic mb-4">{{ $help }}</div>
    @endif
    <div class="relative">
        @php $required = ($req == \App\Enums\General\YesNo::YES()) ? "required" : ""  @endphp
        <input type="date" id="{{ $name }}" name="{{ $name }}" value="{{ $saved }}" {{ $required }}
               class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm">
    </div>
</div>
