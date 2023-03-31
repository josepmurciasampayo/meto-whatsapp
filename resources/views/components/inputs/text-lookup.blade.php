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
</div>
