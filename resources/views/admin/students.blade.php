<x-app-layout>
    <h3 class="my-2">Raw Student Data</h3>
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr class="text-center">
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Date of Birth</th>
            <th>High School</th>
            <th>Country</th>
            <th>Matches</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><a target="_blank" href="{{ route('counselor-student', ['student_id' => $row['student_id']]) }}"><?php echo $row['name'] ?></a></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><a href=""><?php echo $row['phone_raw'] ?></a></td>
            <td><?php echo $row['dob'] ?></td>
            <td><a href="{{ route('highschool', ['highschool_id' => $row['highschool_id']]) }}"><?php echo $row['school'] ?></a></td>
            <td><?php echo '-' ?></td>
            <td class="text-center"><a href="{{ route('matches', ["id" => $row['student_id']]) }}"><?php echo $row['matches'] ?></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
</x-app-layout>
