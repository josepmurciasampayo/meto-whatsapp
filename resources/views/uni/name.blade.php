<x-app-layout>
    @section('title', config('app.name') . ' - University Name')
    <div class="min-h-screen text-center mt-4">
        <x-image-with-text image-src="/img/Meto-background.webp"  alt="" text=""/>

        <div class="d-flex justify-content-center">
            <form method="POST" class="w-50" action="{{ route('uni.name.store') }}">
                @csrf
                <h3 class="display-7 mb-1 mt-4">What is the name of your institution?</h3>
                <x-inputs.text name="name" saved="{{ $uni->name }}"></x-inputs.text>
                <div class="mt-3">
                    <x-button-navigation/>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
