@props(['name', 'label', 'saved' => '', 'options', 'help' => false, 'req' => false])
@php dd($saved); @endphp
@php
    $array = json_decode($saved);
    if ($array === null) {
        $array = new stdClass();
        $array->id = '';
        $array->other = '';
    }
@endphp
<div x-data="{ showOther: '{{ $array->id }}' === 'Other' }" class="my-4 bg-gray-100 px-4 py-3 rounded-md">
    @php $required = ($req) ? "*" : ""  @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 italic mb-4">{{ $help }}</div>
    @endif
    <div class="relative">
        <select id="{{ $name }}" name="{{ $name }}[id]" x-on:change="showOther = $event.target.value === 'Other'" {{ $required }}
            class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm"
        >
            <option value="">Select an option</option>
            {{ $options }}
            <option value="Other">Other</option>
        </select>
        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none"></div>
    </div>
    <div x-show="showOther" class="mt-2">
        <input type="text" id="{{ $name }}_other" name="{{ $name }}[other]" value="{{ $array->other }}"
            class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm"
            placeholder="Enter the 'Other' value"
        >
    </div>
</div>
