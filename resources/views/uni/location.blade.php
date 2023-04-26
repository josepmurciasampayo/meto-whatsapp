<x-app-layout>
    <div class="min-h-screen items-center">
        <x-image-with-text
        image-src="/img/Meto-background.webp"
        alt=""
        text=""/>

        <form method="POST" action="{{ route('uni.location.store') }}" class="text-center">
        @csrf
        <h3 class="display-7 mb-4 mt-6">Country</h3>
        <x-inputs.text name="country"></x-inputs.text>

        <h3 class="display-7 mb-1 mt-6">State/Province</h3>
        <p class="text-xm">leave blank if not applicable</p>
        <x-inputs.text name="state"></x-inputs.text>

        <h3 class="display-7 mb-4 mt-6">City</h3>
        <x-inputs.text name="city"></x-inputs.text>

        <x-button-navigation/>
    </form>
</x-app-layout>
