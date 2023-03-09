<x-app-layout>
    <form method="POST" action="{{ route('uni.application.store') }}" class="text-center">
        @csrf
        <x-input label="What is the website URL that will lead students to your institution's homepage?" name="institution"></x-input>
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
