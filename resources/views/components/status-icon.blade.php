@props(['href', 'icon', 'text', 'progress'])

<a href="{{ $href }}" class="inline-flex flex-col items-center w-48 h-48 bg-green-200 border-3x border-dotted border-gray-400 rounded-xl p-2 hover:bg-green-300 transition-colors">
    <span class="text-4xl text-green-900 mb-2">
        <i class="{{ $icon }}"></i>
    </span>
    <span class="text-base font-medium text-green-900 hover:text-green-600 mb-2">{{ $text }}</span>
    <div class="progress w-full h-6 text-xxs">
        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
    </div>
</a>



