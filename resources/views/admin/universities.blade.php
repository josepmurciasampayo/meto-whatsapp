<x-app-layout>
    <link href="https://unpkg.com/tabulator-tables@5.3.4/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.3.4/dist/js/tabulator.min.js"></script>
        <table id="data" class="table table-striped fs-6" style="width:100%">
            <thead>
            <tr>
                <th>University</th>
                <th>Country</th>
                <th>Count</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data['universities'] as $row) { ?>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['country'] ?></td>
                <td><?php echo isset($data['counts'][$row['id']]) ? $data['counts'][$row['id']] : '-' ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</x-app-layout>
