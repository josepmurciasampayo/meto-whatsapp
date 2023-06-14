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
                <a href="{{ route('question.create') }}"><x-button>Add Question</x-button></a>
            </div>
        @else
            <a href="{{ route('question.create') }}"><x-button>Add Question</x-button></a>
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
            <th>Answers</th>
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
            <th>Answers</th>
        </tr>
        </tfoot>

        <tbody>
        @foreach ($data as $row)
            <tr class="text-center">
                @php $id = $row['id'] @endphp
                <input type="hidden" name="id" id="id" value="{{ $id }}">
                <td><a target="_blank" href="{{ route('question', ['id' => $id]) }}"><?php echo $row['text'] ?></a></td>
                <td><?php echo $type[$row['type']] ?></td>
                <td><?php echo $format[$row['format']] ?></td>
                <td><?php echo $row['order'] ?></td>
                <td><?php echo $active[$row['status']] ?></td>
                <td><?php echo $yesNo[$row['required']] ?></td>
                <td><?php echo $yesNo[$row['equivalency']] ?></td>
                <td><a href="{{ route('answers', ['question_id' => $id]) }}">{{ $row['count'] }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
    </div>
</x-app-layout>
