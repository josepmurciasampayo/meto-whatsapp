@props(['label', 'name', 'text' => '', 'disabled' => false])
<label for="{{ $name }}">{{ $label }}</label>
<textarea id="{{ $name }}" name="{{ $name }}" row="4" {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
   'class' => 'block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50'
   ]) !!}>{{ $text }}</textarea>
