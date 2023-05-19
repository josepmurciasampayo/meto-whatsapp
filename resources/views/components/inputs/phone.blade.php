@props(['label', 'name', 'help' => false, 'saved' => '', 'req' => false])
@php
    if (is_string($saved)) {
        $saved = explode(',', $saved);
    } else {
        $saved = array_values($saved);
    }

    $array = new stdClass();
    $array->code = $saved[0];
    $array->number = $saved[1];
@endphp

<div class="my-4 bg-gray-100 rounded-md p-4">
    @php $required = ($req) ? "*" : ""  @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif
    <div class="flex flex-wrap items-center">
        @php $required = ($req) ? "required" : ""  @endphp
        <select name="{{ $name }}[code]" id="{{ $name }}[code]" class="block w-full sm:w-32 pr-2 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm" {{ $required }}>
            @foreach ($phoneCountries as $code => $country)
                <option value="{{ $code }}" {{ $code == $array->code ? 'selected' : '' }}>{{ $country }}</option>
            @endforeach
        </select>
        <input type="tel" name="{{ $name }}[number]" id="{{ $name }}[number]" value="{{ $array->number }}" placeholder="Enter phone number" class="mt-2 sm:mt-0 flex-1 ml-0 sm:ml-2 block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" pattern="\d{0,10}" maxlength="12" oninput="this.value = this.value.replace(/\D/g, '')">
    </div>
</div>
