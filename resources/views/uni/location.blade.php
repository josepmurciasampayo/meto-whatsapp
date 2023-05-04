<x-app-layout>
    <div class="min-h-screen items-center">
        <x-image-with-text
        image-src="/img/Meto-background.webp"
        alt=""
        text=""/>

        <form method="POST" action="{{ route('uni.location.store') }}" class="text-center">
        @csrf
        <h3 class="display-7 mb-4 mt-6">Country</h3>
        @error('country')
            <p class="text-danger my-0 py-0">{{ $message }}</p>
        @enderror
        <x-inputs.select label="Country" name="country" :options="$countries" />

        <h3 class="display-7 mb-1 mt-6">State/Province</h3>
        <p class="text-xm">leave blank if not applicable</p>
        @error('state')
            <p class="text-danger my-0 py-0">{{ $message }}</p>
        @enderror
        <x-inputs.text name="state"></x-inputs.text>

        <h3 class="display-7 mb-4 mt-6">City</h3>
        @error('city')
            <p class="text-danger my-0 py-0">{{ $message }}</p>
        @enderror
        <x-inputs.text name="city"></x-inputs.text>

        <x-button-navigation/>
    </form>
</x-app-layout>
