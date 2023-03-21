@props(['type' => 'button', 'icon', 'text', 'onclick' => ''])

<div class="flex justify-center items-center">
  <x-button onclick="{{ $onclick }}" type="{{ $type }}">{{ $text }} <i class="{{ $icon }}"></i></x-button>
</div>
