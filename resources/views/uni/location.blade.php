<x-app-layout>
    @section('title', config('app.name') . ' - University Location')

    <div class="d-flex justify-content-center">
        <div class="min-h-screen text-center w-50">
            <x-image-with-text image-src="/img/Meto-background.webp" alt="" text=""/>

            <form method="POST" action="{{ route('uni.location.store') }}" class="w-100">
                @csrf
                <h3 class="display-7 mt-6">Country</h3>
                @error('country')
                <p class="text-danger my-0 py-0">{{ $message }}</p>
                @enderror
                <x-inputs.select saved="{{ $uni->country }}" name="country" :options="$countries" />

                <h3 class="display-7 mt-6">State/Province</h3>
                <p class="text-xm">leave blank if not applicable</p>
                @error('state')
                <p class="text-danger my-0 py-0">{{ $message }}</p>
                @enderror
                <x-inputs.text saved="{{ $uni->state }}" name="state"></x-inputs.text>

                <h3 class="display-7 mt-6">City</h3>
                @error('city')
                <p class="text-danger my-0 py-0">{{ $message }}</p>
                @enderror
                <x-inputs.text saved="{{ $uni->city }}" name="city"></x-inputs.text>

                <div class="mt-3">
                    <x-button-navigation/>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
