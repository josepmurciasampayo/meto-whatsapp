<x-app-layout>
    <?php $format = \App\Enums\QuestionFormat::descriptions() ?>
    <?php $yesNo = \App\Enums\General\YesNo::descriptions() ?>
    <?php $type = \App\Enums\Student\QuestionType::descriptions() ?>
    <div class="my-4 text-end">
        <a href="{{ route('question.create') }}"><x-button>Add Question</x-button></a>
    </div>
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr class="text-center">
            <th>Question</th>
            <th>Type</th>
            <th>Format</th>
            <th>Order</th>
            <th>In Use</th>
            <th>Required</th>
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
                <td><?php echo $yesNo[$row['status']] ?></td>
                <td><?php echo $yesNo[$row['required']] ?></td>
                <td><a href="{{ route('answers', ['question_id' => $id]) }}">{{ $row['count'] }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
</x-app-layout>
