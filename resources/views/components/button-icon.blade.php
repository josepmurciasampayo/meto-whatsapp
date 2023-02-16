@props(['type', 'icon', 'text'])

<div class="flex justify-center items-center">
  <x-button type="{{ $type }}">{{ $text }} <i class="{{ $icon }}"></i></x-button>
</div>
