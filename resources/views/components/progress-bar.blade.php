@props(['progress'])
@if ($progress > 0)
<div class="progress w-full h-6 text-xxs">
    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
</div>
@endif
