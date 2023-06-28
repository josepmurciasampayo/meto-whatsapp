<!-- resources/views/components/country.blade.php -->
@props(['name', 'help' => false, 'saved' => '', 'label' => '', 'req' => false])

@php $countries = App\Models\EnumCountry::orderBy('name', 'asc')->get(); @endphp

@php $required = ($req) ? "*" : ""  @endphp
<label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
@if ($help)
    <div class="text-sm text-gray-600 italic mb-4">{{ $help }}</div>
@endif
<div class="relative">
    @php $required = ($req) ? "required" : ""  @endphp
    <select id="{{ $name }}" name="{{ $name }}" {{ $required }}
            class="block w-full pl-3 pr-10 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm">
        <option value="">Select a country</option>
        @foreach ($countries as $country)
            <option value="{{ $country->name }}" {{ $saved == $country->name ? 'selected' : '' }}>{{ $country->name }} </option>
        @endforeach
    </select>
</div>

