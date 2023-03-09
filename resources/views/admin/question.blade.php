<x-app-layout>
    <?php $formats = \App\Enums\QuestionFormat::descriptions() ?>
    <?php $categories = \App\Enums\Student\QuestionType::descriptions() ?>
    <?php $active = \App\Enums\QuestionStatus::descriptions() ?>
    <?php $yes = \App\Enums\General\YesNo::descriptions() ?>

    <h3 class="display-7 flex justify-center">Editing Question</h3>

    <div class="flex justify-center mt-6 mb-6">
        <x-button-nav href="{{ route('questions') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-50">Back to questions <i class="fas fa-question-circle"></i></x-button-nav>
    </div>

    <form method="POST" action="{{ route('question.store') }}">
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        @csrf
        <x-input saved="{{ $question->text }}" label="Text" name="text"></x-input>
        <x-select label="Format" :options="$formats" name="format" saved="{{ $question->format }}"></x-select>
        <x-select label="Category" :options="$categories" name="category" saved="{{ $question->type }}"></x-select>
        <x-radio label="Required" :options="$yes" name="required" saved="{{ $yes[$question->required] }}"></x-radio>
        <x-radio label="Active" :options="$active" name="active" saved="{{ $active[$question->status] }}"></x-radio>
        <x-input label="Help Text" name="help" saved="{{ $question->help }}"></x-input>
        <x-input label="Order" name="order" saved="{{ $question->order }}"></x-input>
        <x-input label="Screen Number" name="screen" value="{{ $question->screen }}"></x-input>

        @if ($question->hasResponses())
            <input type="hidden" name="toDelete" id="toDelete" value="0">
            <script type="text/javascript">
                function deleteResponse(id) {
                    document.getElementById('toDelete').value = id;
                    document.forms[0].submit();
                }
            </script>
            <h4>Answers</h4>
            @foreach ($responses as $response)
                <div class="row">
                    <div class="col">
                        <x-input label="" name="response[{{ $response->id }}]" saved="{{ $response->text }}"></x-input>
                    </div>
                    <div class="col">
                        <x-button onclick="deleteResponse({{ $response->id }})">Delete</x-button>
                    </div>

                </div>
            @endforeach
            <div class="my-5">Add <x-input style="max-width: 60px" label="" name="responses"></x-input> responses</div>
        @endif

        <x-button>Update</x-button>
    </form>
</x-app-layout>
