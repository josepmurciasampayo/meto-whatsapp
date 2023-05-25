<x-app-layout>
    <div class="min-h-screen items-center">
        <x-image-with-text image-src="/img/Meto-background.webp" alt="" text=""/>

        <form method="POST" action="{{ route('uni.application.store') }}" class="text-center">
            @csrf

            @error('url')
                <p class="text-danger">Please enter a complete URL</p>
            @enderror

            <h3 class="display-7 mb-4 mt-6">What is the website URL that will lead students to your institution's undergraduate application?</h3>

            <x-inputs.text saved="{{ $uni->undergrad_url }}" name="url"></x-inputs.text>
            <x-button-navigation />
        </form>
    </div>
</x-app-layout>
