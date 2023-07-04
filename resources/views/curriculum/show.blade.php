<x-app-layout>
    <div class="my-4">
        <div class="text-start display-6">
            <h3>{{ $curriculum->name }}</h3>
        </div>
        <div class="text-end">
            <a href="{{ route('questions.create') }}"><x-button>Add Question</x-button></a>
        </div>
        <a href="{{ route('curriculum.index') }}"><x-button>Back to Curricula</x-button></a>
    </div>
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr class="text-center">
            <th>Question</th>
            <th>Screen</th>
            <th>Order</th>
            <th>Required</th>
            <th>Equivalency</th>
            <th>Branches</th>
            <th>Format</th>
            <th>Responses</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($questions as $id => $question)
            <tr class="text-center">
                <td><a style="text-decoration: underline" target="_blank" href="{{ route('questions.show', ['question' => $question->id]) }}">{{ $question->text }}</a></td>
                <td>{{ isset($question->academic[0]) ? $question->academic[0]->screen : '' }}</td>
                <td>{{ isset($question->academic[0]) ? $question->academic[0]->order : '' }}</td>
                <td>{{ \App\Enums\General\YesNo::descriptions()[$question->required] ?? ''  }}</td>
                <td>{{ \App\Enums\General\YesNo::descriptions()[$question->academic[0]->equivalency] ?? 'No' }}</td>
                <td>{{ \App\Enums\General\YesNo::descriptions()[$question->academic[0]->branch] ?? 'No' }}</td>
                <td>{{ \App\Enums\QuestionFormat::descriptions()[$question->format] ?? '' }}</td>
                <td>{{ $question->responseCount() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
