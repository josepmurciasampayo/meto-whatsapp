<x-app-layout>
    <div class="min-h-screen mt-5 mx-2 w-full">
    <h3 class="my-2 display-7">Raw Student Data</h3>

    <div class="my-3">
        @include('_partials.response')
    </div>

    <div class="table-container mb-5" style="height: 100vh; overflow-y: scroll;">
        <table id="dataTable" class="table table-striped bg-white">
            <thead>
            <tr class="text-center">
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date of Birth</th>
                <th>High School</th>
                <th>Matches</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $row) { ?>
            <tr>
                <td><a target="_blank" href="{{ route('counselor-student', ['student_id' => $row['student_id']]) }}"><?php echo $row['name'] ?></a></td>
                <td><?php echo $row['email'] ?></td>
                <td><a href=""><?php echo $row['phone_raw'] ?></a></td>
                <td><?php echo $row['dob'] ?></td>
                <td>
                    @if (isset($row['highschool_id']))
                        <a href="{{ route('highschool', ['highschool_id' => $row['highschool_id']]) }}"><?php echo $row['school'] ?></a>
                    @else
                        --
                    @endif
                </td>
                <td class="text-center"><a href="{{ route('matches', ["id" => $row['student_id']]) }}"><?php echo $row['matches'] ?></a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        <x-dataTable></x-dataTable>
    </div>
</x-app-layout>
