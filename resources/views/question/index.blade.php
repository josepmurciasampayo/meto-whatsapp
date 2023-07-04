<x-app-layout>
    <div class="min-h-screen mt-5 mx-2 w-full">
    <?php $format = \App\Enums\QuestionFormat::descriptions() ?>
    <?php $yesNo = \App\Enums\General\YesNo::descriptions() ?>
    <?php $type = \App\Enums\Student\QuestionType::descriptions() ?>
    @php $active = \App\Enums\QuestionStatus::descriptions() @endphp

    <div class="my-4 text-end">
        @if (!App::environment('prod'))
        <div class="row">
            <div class="col">
                <p class="bg-info p-3">Please make changes at <a href="https://app.meto-intl.org">https://app.meto-intl.org</a></p>
            </div>
            <div class="col">
                <a href="{{ route('questions.create') }}"><x-button>Add Question</x-button></a>
            </div>
        @else
            <a href="{{ route('questions.create') }}"><x-button>Add Question</x-button></a>
        @endif
    </div>
    <div class="table-container mb-5" style="height: 100vh; overflow-y: scroll;">
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr class="text-center">
            <th>Question</th>
            <th>Type</th>
            <th>Format</th>
            <th>Order</th>
            <th>In Use</th>
            <th>Required</th>
            <th>Equivalency</th>
            <th>Answer Count</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Question</th>
            <th>Type</th>
            <th>Format</th>
            <th>Order</th>
            <th>In Use</th>
            <th>Required</th>
            <th>Equivalency</th>
            <th>Answer Count</th>
        </tr>
        </tfoot>

        <tbody>
        @foreach ($questions as $question)
            <tr class="text-center">
                <td><a target="_blank" href="{{ route('questions.show', ['question' => $question->id]) }}">{{ $question->text }}</a></td>
                <td>{{ $type[$question->type] ?? 'E' }}</td>
                <td>{{ $format[$question->format] ?? 'E' }}</td>
                <td>{{ $question->order }}</td>
                <td>{{ $active[$question->status] ?? 'E' }}</td>
                <td>{{ $yesNo[$question->required] ?? 'E' }}</td>
                <td>{{ $yesNo[$question->equivalency] ?? 'E' }}</td>
                <td>{{ $question->answerCount() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
    </div>
</x-app-layout>
