<x-app-layout>
    @section('title', config('app.name') . ' - EFC')
    <div class="min-h-screen text-center">
            <x-image-with-text image-src="/img/Meto-background.webp" alt="" text=""/>

            <form method="POST" action="{{ route('uni.efc.store') }}" class="w-50">
                @csrf
                <h3 class="display-7 mt-6">What is the minimum annual financial contribution that a student who receives the top available
                    scholarship would need to be able to contribute? If no minimum, enter '0'. Please use USD and enter only a number.</h3>

                @error('efc')
                    <p class="text-danger py-0 my-0">Please enter only numbers</p>
                @enderror

                <x-inputs.text saved="{{ $uni->efc }}" name="efc" help="Example: The cost of attendance (tuition + rooming + food + health insurance + books + misc
                living expenses) is $30,000 annually. The top scholarship offered is $20,000 annually
                so the minimum that a student's family would need to be able to afford is $10,000. In this case,
                please input 10000 for your answer."></x-inputs.text>

                <div class="mt-3">
                <x-button-navigation />
                </div>
            </form>
    </div>
</x-app-layout>
