<!-- resources/views/components/country-checkbox.blade.php -->

@props(['label', 'name', 'help' => false, 'saved' => ''])

@php
    $countries = App\Models\EnumCountry::orderBy('name', 'asc')->get();
    $savedCountries = explode(',', $saved);
@endphp

<div class="my-4 bg-gray-100 px-4 py-4 rounded-md">
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 italic mb-4">{{ $help }}</div>
    @endif
    <div class="bg-white px-2" style="max-height: 150px; overflow: auto">
        @foreach ($countries as $country)
            <div>
                <input type="checkbox" id="{{ $name }}_{{ $country->id }}" name="{{ $name }}[]" value="{{ $country->id }}" {{ in_array($country->id, $savedCountries) ? 'checked' : '' }} class="rounded text-green-600">
                <label for="{{ $name }}_{{ $country->id }}" class="ml-2">{{ $country->name }}</label>
            </div>
        @endforeach
    </div>
</div>
