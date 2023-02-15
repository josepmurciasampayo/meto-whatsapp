<!-- resources/views/components/image-with-text.blade.php -->

@props([
    'imageSrc' => '',
    'alt' => '',
    'text' => '',
])

<div>
    <img src="{{ $imageSrc }}" alt="{{ $alt }}" class="block mx-auto" style="width: 80px; height:auto"/>
    <div class="display-6 w-full text-center mt-2">{{ $text }}</div>
</div>

