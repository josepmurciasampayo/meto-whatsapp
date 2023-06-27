<x-app-layout>
    @section('title', config('app.name') . ' - University Homepage')
    <div class="min-h-screen text-center">
        <x-image-with-text image-src="/img/Meto-background.webp" alt="" text=""/>

        <form method="POST" action="{{ route('uni.homepage.store') }}" class="w-50">
            @csrf
            <h3 class="display-7 mb-1 mt-4">What is the website URL that will lead students to your institution's homepage?</h3>
            <x-inputs.text saved="{{ $uni->url }}" name="url"></x-inputs.text>
            <div class="mt-3">
            <x-button-navigation/>
            </div>
        </form>
    </div>
</x-app-layout>
