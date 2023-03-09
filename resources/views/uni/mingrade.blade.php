<x-app-layout>
    <form method="POST" action="{{ route('uni.mingrade.store') }}" class="text-center">
        @csrf
        <?php $options = \App\Enums\Student\Curriculum::descriptions() ?>
        <x-radio :options="$options" label="What are the approximate grades for the lowest performing admitted students?
         Please select minimum grades from one of the following curricula."
                 help="Meto will use this to show you academically relevant students across curricula (e.g. if you select
                 a “B” in Cambridge curriculum for minimum grades, you will see all students with “B” or better grades
                  in Cambridge and equivalent grades across all curricula on Meto’s database). You are welcome to change this later." name="efc"></x-radio>
        <div class="row">
            <div class="col">
                <x-button>Back</x-button>
            </div>
            <div class="col">
                <x-button type="submit">Next</x-button>
            </div>
        </div>
    </form>
</x-app-layout>
