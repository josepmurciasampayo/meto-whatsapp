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
            <th>In Use</th>
            <th>Required</th>
            <th>Transfer</th>
            <th>Kenyan</th>
            <th>Rwandan</th>
            <th>IB</th>
            <th>Other</th>
            <th>Ugandan</th>
            <th>American</th>
            <th>Cambridge</th>
            <th>Answers</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Question</th>
            <th>Type</th>
            <th>Format</th>
            <th>In Use</th>
            <th>Required</th>
            <th>Transfer</th>
            <th>Kenyan</th>
            <th>Rwandan</th>
            <th>IB</th>
            <th>Other</th>
            <th>Ugandan</th>
            <th>American</th>
            <th>Cambridge</th>
            <th>Answers</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr class="text-center">
            <input type="hidden" name="id" id="id" value="{{ $row['id'] }}">
            <td><a target="_blank" href="{{ route('question', ['id' => $row['id']]) }}"><?php echo $row['text'] ?></a></td>
            <td><?php echo $type[$row['type']] ?></td>
            <td><?php echo $format[$row['format']] ?></td>
            <td><?php echo $yesNo[$row['status']] ?></td>
            <td><?php echo $yesNo[$row['required']] ?></td>
            <td><?php echo $yesNo[$row[7]] ?></td>
            <td><?php echo $yesNo[$row[1]] ?></td>
            <td><?php echo $yesNo[$row[3]] ?></td>
            <td><?php echo $yesNo[$row[5]] ?></td>
            <td><?php echo $yesNo[$row[8]] ?></td>
            <td><?php echo $yesNo[$row[6]] ?></td>
            <td><?php echo $yesNo[$row[2]] ?></td>
            <td><?php echo $yesNo[$row[4]] ?></td>
            <td><a href="{{ route('answers', ['question_id' => $row['id']]) }}"><?php echo $row['count'] ?></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
</x-app-layout>
