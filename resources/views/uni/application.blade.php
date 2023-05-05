
<x-app-layout>
    <div class="min-h-screen items-center">
        <x-image-with-text
        image-src="/img/Meto-background.webp"
        alt=""
        text=""/>

        <form method="POST" action="{{ route('uni.application.store') }}" class="text-center">
        @csrf
        <h3 class="display-7 mb-4 mt-6">What is the website URL that will lead students to your institution's undergraduate application?</h3>

        @error('institution')
            <p class="text-danger">{{ $message }}</p>
        @enderror

        <x-inputs.text name="institution"></x-inputs.text>
        <x-button-navigation/>
    </form>
</x-app-layout>
