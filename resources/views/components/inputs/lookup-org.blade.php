@props(['label' => '', 'name', 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false])
<div class="my-4 bg-gray-100 rounded-md p-4">
    @php $required = ($req == \App\Enums\General\YesNo::YES()) ? "*" : ""  @endphp
    <label for="{{ $name }}" class="text-lg font-medium text-gray-800 mb-2">{!! $label ?? $slot !!} {{ $required }}</label>

    @if ($help)
        <div>{{ $help }}</div>
    @endif

    @php $required = ($req == \App\Enums\General\YesNo::YES()) ? "*" : ""  @endphp
    <input value="{{ $saved }}" name="{{ $name }}" id="{{ $name }}" {{ $disabled ? 'disabled' : '' }} {{ $required }} {!! $attributes->merge([
'class' => 'block h-10 w-full mb-6 rounded-md shadow-sm border border-gray-400 focus:border-blue-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 bg-green-100 text-green-800'
]) !!}>
    <input type="hidden" id="lookupID" name="lookupID" value="">
</div>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $( "#{{ $name }}" ).autocomplete({
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                    url:"{{ route('orgLookup') }}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: '{{ csrf_token() }}',
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                $('#{{ $name }}').val(ui.item.label); // display the selected text
                $('#lookupID').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });
</script>
