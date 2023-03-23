@props(['label' => '', 'name', 'help' => false, 'saved' => ''])

<div class="my-4 bg-gray-100 rounded-md p-4">
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }}</label>
    @if ($help)
    <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif
    <input value="{{ $saved }}" name="{{ $name }}" id="{{ $name }}-search" type="text" class="block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white">
</div>

@push('scripts')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var route = "{{ url('search-high-schools') }}";
    $('#{{ $name }}-search').typeahead({
        source: function (query, process) {
            return $.get(route, {
                query: query
            }, function (data) {
                return process(data);
            });
        }
    });
</script>
@endpush
