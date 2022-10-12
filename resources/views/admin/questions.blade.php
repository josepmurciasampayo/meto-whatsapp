<x-app-layout>

    <div class="container bg-white">
        <table id="data" class="table table-striped fs-6" style="width:100%">
            <thead>
            <tr>
                <th>Question</th>
                <th>Type</th>
                <th>In Use</th>
                <th>Answers</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $row) { ?>
            <tr>
                <td><?php echo $row['curriculum'] ?></td>
                <td><?php echo $row['country'] ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</x-app-layout>
