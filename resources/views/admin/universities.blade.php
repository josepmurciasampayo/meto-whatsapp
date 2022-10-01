<x-app-layout>
    <link href="https://unpkg.com/tabulator-tables@5.3.4/dist/css/tabulator.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://unpkg.com/tabulator-tables@5.3.4/dist/js/tabulator.min.js"></script>
    <div class="container bg-white">
        <div id="match-data"></div>
        <script type="text/javascript">
            <?php echo $data ?>

            var table = new Tabulator("#match-data", {
                height: 605, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
                data: tabledata, //assign data to table
                layout:"fitColumns", //fit columns to width of table (optional)
                columns:[ //Define Table Columns
                    {title:"Student", field:"student"},
                    {title:"Institution", field:"institution"},
                    {title:"Date", field:"date", sorter:"date"},
                    {title:"Status", field:"status"},
                ],
            });
        </script>
    <!--
        <table id="data" class="table table-striped fs-6" style="width:100%">
            <thead>
            <tr>
                <th>Student</th>
                <th>Institution</th>
                <th>Match Date</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <?php /*foreach ($data as $row) { ?>
            <?php $date = new DateTime($row['match_date']); ?>
            <tr>
                <td><?php echo $row['first'] . ' ' . $row['last'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $date->format('D, M j g:ia') ?></td>
                <td><?php echo $row['match_status'] ?></td>
            </tr>
            <?php } */?>
        </tbody>
    </table>
-->
    </div>
</x-app-layout>
