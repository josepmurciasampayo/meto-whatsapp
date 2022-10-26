<x-app-layout>
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr>
            <th>High School</th>
            <th>Curriculum</th>
            <th>Country</th>
            <th>Students</th>
            <th>Matches</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>High School</th>
            <th>Curriculum</th>
            <th>Country</th>
            <th>Students</th>
            <th>Matches</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><a href="{{ route('highschool', ['highschool_id' => $row['id']]) }}"><?php echo $row['name'] ?></a></td>
            <td><?php echo $row['curriculum'] ?></td>
            <td><?php echo $row['country'] ?></td>
            <td class="text-center"><a href="{{ route('students', ['highschool_id' => $row['id']]) }}"><?php echo $row['students'] ?></a></td>
            <td class="text-center">TBD</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
</x-app-layout>
