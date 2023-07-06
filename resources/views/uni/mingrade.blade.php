<x-app-layout>
    @section('title', config('app.name') . ' - Minimum Academic Performance')
    <div class="d-flex justify-content-center text-center mt-4">
        <div class="w-50">
            <x-image-with-text image-src="/img/Meto-background.webp" alt="" text=""/>

            @livewire('uni.questions.min-grade-form')
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.querySelector("#efc[9]")
            document.querySelector('mingrade_score')
            let input = $("input[name='efc']");
            let scoreInput = $('[name="mingrade_score"]');
            input.on('change', () => {
                // Change the min_grade score list
                console.log()
            })
        }, 300);
    </script>
</x-app-layout>
