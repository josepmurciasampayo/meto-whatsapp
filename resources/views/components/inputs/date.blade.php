<!-- date.blade.php -->
@props(['name', 'help' => false, 'saved' => null, 'label' => '', 'req' => false, 'class' => '', 'starting' => null])

@php
    $startDate = ($saved) ? '"startDate": "'.$saved.'",' : '"startDate": "2001-01-01",';
    $required = ($req) ? "*" : ""
@endphp

<label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
@if ($help)
    <div class="text-sm text-gray-600 italic mb-4">{{ $help }}</div>
@endif
<div class="text-sm text-gray-600 italic mb-4">You can also type the date as yyyy/mm/dd</div>
<div class="relative">
    @php $required = ($req) ? "required" : ""  @endphp
    <input id="{{ $name }}" name="{{ $name }}" value="{{ $saved }}" {{ $required }}
           class="{{ $class }} datepicker block pl-3 pr-10 py-2 rounded-md border-indigo-300 focus:ring focus:ring-indigo-200  text-gray-900 sm:text-sm">
</div>

@once
    <!-- Date range picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $('.datepicker').daterangepicker({
            "singleDatePicker": true,
            "autoUpdateInput": true,
            "showDropdowns": true,
            "autoApply": true,
            "minYear": 2000,
            "maxYear": new Date().getFullYear() + 1,
            {!! $startDate !!}
            "locale": {
                format: 'YYYY-MM-DD',
            },
            "opens": "center"
        });
    </script>
@endonce
