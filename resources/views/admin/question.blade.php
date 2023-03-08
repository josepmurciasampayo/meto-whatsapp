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
        <x-input-text saved="{{ $question->text }}" label="Text" name="text"></x-input-text>
        <x-select label="Format" :options="$formats" name="format" saved="{{ $question->format }}"></x-select>
        <x-select label="Category" :options="$categories" name="category" saved="{{ $question->type }}"></x-select>
        <x-radio label="Required" :options="$yes" name="required" saved="{{ $yes[$question->required] }}"></x-radio>
        <x-radio label="Active" :options="$active" name="active" saved="{{ $active[$question->status] }}"></x-radio>
        <x-input-text label="Help Text" name="help" saved="{{ $question->help }}"></x-input-text>
        <x-input-text label="Order" name="order" saved="{{ $question->order }}"></x-input-text>
        <x-input-text label="Screen Number" name="screen" value="{{ $question->screen }}"></x-input-text>

        @if ($question->hasResponses())
            <input type="hidden" name="toDelete" id="toDelete" value="0">
            <script type="text/javascript">
                function deleteResponse(id) {
                    document.getElementById('toDelete').value = id;
                    document.forms[0].submit();
                }
            </script>
            <div class="display-7">Answers <i class="fas fa-check-square"></i></div>
            @foreach ($responses as $response)
                <div class="row">
                    <div class="col">
                        <x-input-text name="response[{{ $response->id }}]" value="{{ $response->text }}"></x-input-text>
                    </div>
                    <div class="col flex justify-center items-center">
                        <x-button onclick="deleteResponse({{ $response->id }})">
                            <span class="mr-2">
                                <i class="fas fa-trash"></i>
                            </span>
                            Delete
                        </x-button>
                    </div>

                </div>
            @endforeach
            <div class="display-7 my-5">Add <i class="far fa-plus-square"></i> <x-input-text style="max-width: 60px" label="" name="responses"></x-input-text> Responses <i class="fas fa-comment-dots"></i></div>
        @endif

        <x-button>Update <i class="fas fa-pencil-alt"></i></x-button>
    </form>
</x-app-layout>
