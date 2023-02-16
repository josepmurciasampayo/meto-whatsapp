@props(['href', 'icon', 'text'])

<a href="{{ $href }}" class="inline-flex items-center bg-green-200 border border-dashed border-gray-400 rounded-xl p-2 hover:bg-green-400 transition-colors">
    <i class="{{ $icon }} text-2xl text-green-900 mr-2"></i>
    <span class="text-base font-medium text-green-900">{{ $text }}</span>
</a>

