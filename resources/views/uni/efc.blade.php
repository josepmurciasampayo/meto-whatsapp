<x-app-layout>
    <form method="POST" action="{{ route('uni.efc.store') }}" class="text-center">
        @csrf
        <x-input label="What is the minimum annual financial contribution that a student who receives the top available
        scholarship would need to be able to contribute? If no minimum, enter '0'. Please use USD and enter only a number."
                 help="example: The cost of attendance (tuition + rooming + food + health insurance + books + misc
                 living expenses) at ABC University is $30,000 annually. The top scholarship offered is $20,000 annually.
                 So, the minimum that a student's family would need to be able to afford is $10,000. In this case,
                 please input 10,000 for your answer." name="efc"></x-input>
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
