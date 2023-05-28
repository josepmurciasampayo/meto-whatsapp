<x-app-layout>
    <div class="min-h-screen items-center">
        <x-image-with-text
        image-src="/img/Meto-background.webp"
        alt=""
        text=""/>

        <form method="POST" action="{{ route('uni.mingrade.store') }}" class="text-center">
            @csrf

            @php
                $options = \App\Enums\Student\Curriculum::getSchoolChoices();
                if (in_array($other = \App\Enums\Student\Curriculum::OTHER(), array_keys($options))) {
                    unset($options[$other]);
                }
            @endphp

            <h3 class="display-7 mb-4 mt-6">What are the approximate grades for the lowest performing admitted students?
                Please select minimum grades from one of the following curricula.</h3>
            <x-inputs.radio :options="$options"
                     help="Meto will use this to show you academically relevant students across curricula (e.g. if you select
                     a “B” in Cambridge curriculum for minimum grades, you will see all students with “B” or better grades
                      in Cambridge and equivalent grades across all curricula on Meto’s database). You are welcome to change this later." name="efc"></x-inputs.radio>
                      <x-button-navigation/>
        </form>

        <script>
            setTimeout(() => {
                let input = $("input[name='efc']");
                input.on('change', () => {
                    // Change the min_grade score list
                })
            }, 300);
        </script>
</x-app-layout>
