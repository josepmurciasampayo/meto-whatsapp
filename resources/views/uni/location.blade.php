<x-app-layout>
    <form method="POST" action="{{ route('uni.location.store') }}" class="text-center">
        @csrf
        <x-input label="Country" name="country"></x-input>
        <x-input label="State/Province (leave blank if not applicable)" name="state"></x-input>
        <x-input label="City" name="city"></x-input>
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
