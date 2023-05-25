<x-app-layout>
    <div class="min-h-screen items-center">
        <x-image-with-text
        image-src="/img/Meto-background.webp"
        alt=""
        text=""/>

    <form method="POST" action="{{ route('uni.name.store') }}" class="text-center">
        @csrf
        <h3 class="display-7 mb-4 mt-6">What is the name of your institution?</h3>
        <x-inputs.text name="name" saved="{{ $uni->name }}"></x-inputs.text>
        <x-button-navigation/>
    </form>
</x-app-layout>
