<x-app-layout>
    <link href="https://unpkg.com/tabulator-tables@5.3.4/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.3.4/dist/js/tabulator.min.js"></script>
    <div class="container bg-white">
        <table id="data" class="table table-striped fs-6" style="width:100%">
            <thead>
            <tr>
                <th>High School</th>
                <th>Curriculum</th>
                <th>Country</th>
                <th>Count of Students</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $row) { ?>
            <tr>
                <td><a href="{{ route('highschool', ['id' => $row['id']]) }}"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['curriculum'] ?></td>
                <td><?php echo $row['country'] ?></td>
                <td><?php echo $row['students'] ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</x-app-layout>
