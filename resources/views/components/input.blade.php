@props(['label' => '', 'name', 'help' => false, 'disabled' => false, 'saved' => "", 'required' => false])
@php $requiredText = ($required) ? "*" : "" @endphp
<label for="{{ $name }}" class="block font-bold text-l text-gray-700 mt-2">{{ htmlspecialchars($label) ?? $slot }} {{ $requiredText }}</label>

@if ($help)
    <div>{{ $help }}</div>
@endif

@php $requiredText = ($required) ? "required" : "" @endphp
<input value="{{ $saved }}" name="{{ $name }}" id="{{ $name }}" {{ $disabled ? 'disabled' : '' }} {{ $requiredText }} {!! $attributes->merge([
'class' => 'block h-10 w-full mb-6 rounded-md shadow-sm border border-gray-400 focus:border-blue-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 bg-green-100 text-green-800'
]) !!}>
