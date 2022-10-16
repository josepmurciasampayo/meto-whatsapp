<x-app-layout>
    <table id="data" class="table table-striped fs-6" style="width:100%">
        <thead>
        <tr>
            <th>High School</th>
            <th>Curriculum</th>
            <th>Country</th>
            <th>Students</th>
            <th>Matches</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><a href="{{ route('highschool', ['id' => $row['id']]) }}"><?php echo $row['name'] ?></a></td>
            <td><?php echo $row['curriculum'] ?></td>
            <td><?php echo $row['country'] ?></td>
            <td class="text-center"><a href="{{ route('students', ['id' => $row['id']]) }}"><?php echo $row['students'] ?></a></td>
            <td class="text-center">TBD</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</x-app-layout>
