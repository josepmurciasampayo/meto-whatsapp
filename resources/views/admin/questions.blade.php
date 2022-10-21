<x-app-layout>
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr class="text-center">
            <th>Question</th>
            <th>Type</th>
            <th>In Use</th>
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
            <th>In Use</th>
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
            <td><a href="{{ route('answers', ['question_id' => $row['id']]) }}"><?php echo $row['text'] ?></a></td>
            <td><?php echo $row['type'] ?></td>
            <td><?php echo $row['in_use'] ?></td>
            <td><?php echo $row['7'] ?></td>
            <td><?php echo $row['1'] ?></td>
            <td><?php echo $row[3] ?></td>
            <td><?php echo $row[5] ?></td>
            <td><?php echo $row[8] ?></td>
            <td><?php echo $row[6] ?></td>
            <td><?php echo $row[2] ?></td>
            <td><?php echo $row[4] ?></td>
            <td><a href="{{ route('answers', ['question_id' => $row['id']]) }}"><?php echo $row['count'] ?></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
</x-app-layout>
