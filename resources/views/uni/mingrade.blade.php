<x-app-layout>
    @section('title', config('app.name') . ' - Minimum Academic Performance')
    <div class="d-flex justify-content-center text-center mt-4">
        <div class="w-50">
            <x-image-with-text image-src="/img/Meto-background.webp" alt="" text=""/>

            @livewire('uni.questions.min-grade-form')
        </div>
    </div>
</x-app-layout>
