<x-app-layout>
    <form method="POST" action="{{ route('uni.name.store') }}" class="text-center">
        @csrf
        <x-input label="What is the name of your institution" name="institution"></x-input>
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
