<div>
    <form method="POST" wire:submit.prevent="saveMingrade()" action="{{ route('uni.mingrade.store') }}" class="text-center">
        @csrf

        @php
            $curricula = \App\Enums\Student\Curriculum::getSchoolChoices();
            unset($curricula[\App\Enums\Student\Curriculum::OTHER()]);
        @endphp

        <h3 class="display-7 mb-4 mt-6">What are the approximate grades for the lowest performing admitted students?
            Please select minimum grades from one of the following curricula.</h3>

        @error('option')
        <p class="text-danger">{{ $message }}</p>
        @enderror

        <x-inputs.radio wire="curriculum" :options="$curricula" name="efc"
                        help="Meto will use this to show you academically relevant students across curricula.
                        If you select a “B” in Cambridge curriculum for minimum grades, you will see all students with “B” or better grades
                        in Cambridge and equivalent grades across all curricula on Meto’s database.
                        You are welcome to change this later." ></x-inputs.radio>

        @error('selectedScoreOption')
        <p class="text-danger">{{ $message }}</p>
        @enderror
        <x-inputs.radio wire="selectedScoreOption" style="display: none;" name="mingrade_score" :options="$scoreOptions" help="Minimum Acceptance Score"></x-inputs.radio>

        <x-button-navigation />
    </form>
</div>
