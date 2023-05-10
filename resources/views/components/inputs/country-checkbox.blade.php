<!-- resources/views/components/country-checkbox.blade.php -->
@props(['label', 'name', 'help' => false, 'saved' => '', 'req' => false])

@php
    $countries = App\Models\EnumCountry::orderBy('name', 'asc')->get();
    $savedCountries = explode(',', $saved);
    $checkedCount = 0;
@endphp

<div class="my-4 bg-gray-100 px-4 py-4 rounded-md">
    @php $required = ($req) ? '*' : '' @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 italic mb-4">{{ $help }}</div>
    @endif
    <div class="bg-white px-2" style="max-height: 150px; overflow: auto">
        @php $required = ($req) ? 'required' : '' @endphp
        @foreach ($countries as $country)
            @if ($checkedCount < 5)
                <div>
                    <input type="checkbox" id="{{ $name }}[{{ $country->id }}]" name="{{ $name }}[{{ $country->id }}]" value="{{ $country->id }}" {{ in_array($country->id, $savedCountries) ? 'checked' : '' }} class="rounded text-green-600" onclick="checkLimit(this)">
                    <label for="{{ $name }}[{{ $country->id }}]" class="ml-2" {{ $required }}>{{ $country->name }}</label>
                </div>
            @else
                <div>
                    <input type="checkbox" id="{{ $name }}[{{ $country->id }}]" name="{{ $name }}[{{ $country->id }}]" value="{{ $country->id }}" {{ in_array($country->id, $savedCountries) ? 'checked' : '' }} class="rounded text-green-600" disabled>
                    <label for="{{ $name }}[{{ $country->id }}]" class="ml-2" {{ $required }}>{{ $country->name }}</label>
                </div>
            @endif
        @endforeach
    </div>
</div>

<script>
    function checkLimit(checkbox) {
        if (checkbox.checked) {
            if ($('input[type=checkbox]:checked').length > 5) {
                checkbox.checked = false;
                alert('You can only select up to 5 options.');
            } else {
                $checkedCount++;
            }
        } else {
            $checkedCount--;
        }
    }
</script>
