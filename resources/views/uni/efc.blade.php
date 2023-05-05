<x-app-layout>
    <div class="min-h-screen items-center">
        <x-image-with-text
        image-src="/img/Meto-background.webp"
        alt=""
        text=""/>

        <form method="POST" action="{{ route('uni.efc.store') }}" class="text-center">
        @csrf
        <h3 class="display-7 mb-4 mt-6">What is the minimum annual financial contribution that a student who receives the top available
            scholarship would need to be able to contribute? If no minimum, enter '0'. Please use USD and enter only a number.</h3>
        @error('efc')
            <p class="text-danger py-0 my-0">{{ $message }}</p>
        @enderror
        <x-inputs.text name="efc"  help="example: The cost of attendance (tuition + rooming + food + health insurance + books + misc
        living expenses) at ABC University is $30,000 annually. The top scholarship offered is $20,000 annually.
        So, the minimum that a student's family would need to be able to afford is $10,000. In this case,
        please input 10,000 for your answer."></x-inputs.text>
        <x-button-navigation/>
    </form>
</x-app-layout>
