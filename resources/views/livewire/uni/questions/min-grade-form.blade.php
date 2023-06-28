<div>
    <form method="POST" wire:submit.prevent="saveMingrade()" action="{{ route('uni.mingrade.store') }}" class="w-50">
        @csrf

        @php
            $curricula = \App\Enums\Student\Curriculum::getSchoolChoices();
            unset($curricula[\App\Enums\Student\Curriculum::OTHER()]);
        @endphp

        <h3 class="display-7 mb-4 mt-6">
            What is the academic performance for the lowest performing admitted students?
        </h3>
        <h5>
            {{ config('app.name') }} will use this to show you students meeting your requirements.
            For example, if you select a “BBB” in Cambridge curriculum, you will see all students with that level or better performance
            across all curricula in {{ config('app.name') }}’s database.
            You are welcome to change this later.
        </h5>

        @error('option')
        <p class="text-danger">{{ $message }}</p>
        @enderror

        <div class="mt-4">
        <x-inputs.radio wire="curriculum" :options="$curricula" name="efc" label="Curriculum"></x-inputs.radio>
        </div>

        @error('selectedScoreOption')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <x-inputs.radio wire="selectedScoreOption" style="display: none;" name="mingrade_score" :options="$scoreOptions" label="Minimum Acceptable Score"></x-inputs.radio>

        <x-button-navigation />
    </form>
</div>
