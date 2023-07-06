<x-app-layout>
    @section('title', config('app.name') . ' - Application URL')
    <div class="min-h-screen text-center">
        <x-image-with-text image-src="/img/Meto-background.webp" alt="" text=""/>

        <div class="d-flex justify-content-center">
            <form method="POST" action="{{ route('uni.application.store') }}" class="w-50">
                @csrf

                @error('url')
                <p class="text-danger">Please enter a complete URL</p>
                @enderror

                <h3 class="display-7 mb-1 mt-4">What is the website URL that will lead students to your institution's undergraduate application?</h3>

                <x-inputs.text saved="{{ $uni->undergrad_url }}" name="url"></x-inputs.text>
                <div class="mt-3">
                    <x-button-navigation />
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
