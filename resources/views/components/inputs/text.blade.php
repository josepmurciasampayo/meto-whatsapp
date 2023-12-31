@props(['label' => '', 'name', 'class' => '', 'type' => null, 'help' => false, 'disabled' => false, 'saved' => "", 'req' => false, 'mask' => '', 'placeholder' => ''])

@php $required = ($req) ? "*" : ""  @endphp
<label class="text-lg font-medium text-gray-800 mb-2">{{ $label }} {{ $required }}</label>
@if ($help)
<div class="text-sm text-gray-600 mb-4">{{ $help }}</div>
@endif
<input
    value="{!! $saved !!}"
    name="{{ $name }}"
    id="{{ $name }}"
    type="{{ $type ?? 'text' }}"
    {{ $disabled ? 'disabled' : '' }}
    {{ $required ? 'required' : null }}
    placeholder="{{ $placeholder }}"
    class="{{ $class }} block w-full pr-10 pl-3 py-2 rounded-md border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-gray-900 sm:text-sm bg-white">

