<x-app-layout>

    <div class="container bg-white">
        <table id="data" class="table table-striped fs-6" style="width:100%">
            <thead>
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
            </thead>
            <tbody>
            <?php foreach ($data as $row) { ?>
            <tr class="text-center">
                <input type="hidden" name="id" id="id" value="{{ $row['id'] }}">
                <td><?php echo $row['text'] ?></td>
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
    </div>
</x-app-layout>
