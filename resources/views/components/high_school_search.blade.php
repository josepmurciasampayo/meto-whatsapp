@props(['label' => '', 'name', 'help' => false, 'saved' => ''])

<div class="my-4 bg-gray-100 rounded-md p-4">
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }}</label>
    @if ($help)
    <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif
    <input value="{{ $saved }}" name="{{ $name }}" id="{{ $name }}-search" type="text" class="block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white">
</div>

@push('scripts')
<script>
    $(document).ready(function () {
        // Initialize Typeahead.js
        const highSchoolSearch = $('#{{ $name }}-search').typeahead({
            minLength: 2,
            highlight: true,
        }, {
            name: 'high-schools',
            source: searchHighSchools,
            display: 'name',
        });

        // Function to fetch high schools from the backend
        function searchHighSchools(query, syncResults, asyncResults) {
            $.get("{{ route('search-high-schools') }}", {query: query}, function (data) {
                asyncResults(data);
            });
        }
    });
</script>
@endpush
