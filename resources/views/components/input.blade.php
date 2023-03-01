@props(['label', 'name', 'disabled' => false])
<label for="{{ $name }}" class="block font-bold text-l text-gray-700 mt-2">{{ $label ?? $slot }}</label>
<input name="{{ $name }}" id="{{ $name }}" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
   'class' => 'block h-10 w-full mb-6 rounded-md shadow-sm border border-gray-400 focus:border-blue-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 px-3 bg-green-100 text-green-800'
   ]) !!}>
@if ($question->help)
    <div>{{ $question->help }}</div>
@endif
