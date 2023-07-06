<x-app-layout>
    <div class="min-h-screen mt-3">
        <x-image-with-text image-src="/img/Meto-background.webp"/>
        <div class="w-full lg:w-3/4 xl:max-w-md mt-6 px-6 py-4 bg-success bg-opacity-25 overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('student.handle') }}" id="question-form">
                <div id="errors-msg-output" class="alert alert-danger d-none"></div>
                <input type="hidden" name="page" value="{{ $page ?? null }}">
                <input type="hidden" name="curriculum" value="{{ $curriculum ?? null }}">
                <input type="hidden" name="screen" value="{{ $screen ?? null }}">
                <input type="hidden" name="direction" id="direction" value="1">
                @csrf
                @foreach ($questions as $question)
                    @php $a = $answers[$question->id] ?? null @endphp

                    <div class="my-1">
                        @if (($question->hasResponses()))
                            <x-question :question="$question" :answer="$a" :responses="$question->responses"></x-question>
                        @else
                            <x-question :question="$question" :answer="$a"></x-question>
                        @endif
                    </div>
                @endforeach

                <x-button-navigation :page="$page" :screen="$screen" :answers="$answers"/>

            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let form = $('#question-form')
        form.validate({
            submitHandler: function (form) {
                form.submit();
            },
            invalidHandler: function(event, validator) {
                // 'this' refers to the form
                var errors = validator.numberOfInvalids();
                if (errors) {
                    var message = errors == 1
                        ? 'You missed 1 field. It has been highlighted'
                        : 'You missed ' + errors + ' fields. They have been highlighted';
                    $('#errors-msg-output').removeClass('d-none')
                        .html(message)
                } else {
                    $('#errors-msg-output').addClass('d-none')
                }

                let errorBag = validator.invalid

                if (errorBag) {
                    window.scrollTo(0, 0);

                    document.querySelectorAll('.validation-error').forEach(validationError => {
                        validationError.remove()
                    })

                    Object.keys(errorBag).forEach(key => {
                        let el = document.querySelector("[question-id='" + key + "'] div")
                        let oldEl = el.innerHTML
                        let error = null
                        el.querySelector('.validation-error') ? error = '' : error = "<label class='validation-error text-danger small'>" + errorBag[key] + "</label>"
                        el.innerHTML = oldEl + error
                    })
                }
            }
        })
    </script>
</x-app-layout>
