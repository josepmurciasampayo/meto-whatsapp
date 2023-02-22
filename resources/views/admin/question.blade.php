<x-app-layout>
    <?php $formats = \App\Enums\QuestionFormat::descriptions() ?>
    <?php $categories = \App\Enums\Student\QuestionType::descriptions() ?>
    <?php $active = \App\Enums\QuestionStatus::descriptions() ?>
    <?php $yes = \App\Enums\General\YesNo::descriptions() ?>

    <h3>Editing Question</h3>
    <a href="{{ route('questions') }}">Back to questions</a>
    <form method="POST" action="{{ route('question.store') }}">
        <input type="hidden" name="question_id" value="{{ $question->id }}">
        @csrf
        <x-input label="Text" name="text" value="{{ $question->text }}"></x-input>
        <x-select label="Format" :options="$formats" name="format" saved="{{ $question->format }}"></x-select>
        <x-select label="Category" :options="$categories" name="category" saved="{{ $question->type }}"></x-select>
        <x-radio label="Required" :options="$yes" name="required" saved="{{ $question->required }}"></x-radio>
        <x-radio label="Active" :options="$active" name="active" saved="{{ $question->status }}"></x-radio>
        <x-input label="Order" name="order" value="{{ $question->order }}"></x-input>

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
                        <x-input name="response[{{ $response->id }}]" value="{{ $response->text }}"></x-input>
                    </div>
                    <div class="col">
                        <x-button onclick="deleteResponse({{ $response->id }})">Delete</x-button>
                    </div>

                </div>
            @endforeach
            <div class="my-5">Add <x-input style="max-width: 60px" name="responses"></x-input> responses</div>
        @endif

        <x-button>Update</x-button>
    </form>
</x-app-layout>
