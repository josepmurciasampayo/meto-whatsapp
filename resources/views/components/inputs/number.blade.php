@props(['label', 'name', 'help' => false, 'saved' => '', 'req' => false])

<div class="my-4 bg-gray-100 rounded-md p-4">
    @php $required = ($req == \App\Enums\General\YesNo::YES()) ? "*" : ""  @endphp
    <label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
    @if ($help)
        <div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
    @endif
    <div class="flex flex-wrap items-center">
        @php $required = ($req == \App\Enums\General\YesNo::YES()) ? "required" : ""  @endphp
        <input type="number" name="{{ $name }}" id="{{ $name }}" value="{{ $saved }}" class="mt-2 sm:mt-0 flex-1 ml-0 sm:ml-2 block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white" pattern="\d{0,10}" {{ $required }}>
    </div>
</div>
