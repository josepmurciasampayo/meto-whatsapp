<x-app-layout>
    // TODO: improve peformance of this (paging?)
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr>
            <th>Student</th>
            <th>Institution</th>
            <th>Match Date</th>
            <th>Status</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Student</th>
            <th>Institution</th>
            <th>Match Date</th>
            <th>Status</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data as $row) { ?>
        <?php $date = new DateTime($row['match_date']); ?>
        <tr>
            <td><?php echo $row['first'] . ' ' . $row['last'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $date->format('D, M j g:ia') ?></td>
            <td><?php echo $row['match_status'] ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
</x-app-layout>
