<x-app-layout>
    <x-notes-counselor :notes="$notes"></x-notes-counselor>
    <h3 class="my-2">Student Data</h3>
    <table id="dataTable" class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actively Applying</th>
            <th>Matches</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actively Applying</th>
            <th>Matches</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data as $row) { ?>
            <tr>
                <td><a href="{{ route('counselor-student', ['student_id' => $row['student_id']]) }}">{{ $row['name'] }}</a></td>
                <td>{{ $row['gender'] }}</td>
                <td>{{ $row['email'] }}</td>
                <td>{{ $row['phone'] }}</td>
                <td>{{ $row['active'] }}</td>
                <td>{{ $row['matches'] }}</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<x-dataTable></x-dataTable>
</x-app-layout>
