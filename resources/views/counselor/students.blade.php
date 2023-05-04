<x-app-layout>
    <div class="min-h-screen mt-5 mx-2">
    <x-notes-counselor :notes="$notes"></x-notes-counselor>
    <h3 class="my-2 display-7">Student Data</h3>

    <div class="table-container" style="height: 400px; overflow-y: scroll;">

    <x-dataTable></x-dataTable>
    <table id="dataTable" class="table table-striped bg-white">
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
                <td><a class="my-link" href="{{ route('counselor-student', ['student_id' => $row['student_id']]) }}">{{ $row['name'] }}</a></td>
                <td>{{ $row['gender'] }}</td>
                <td>{{ $row['email'] }}</td>
                <td>{{ $row['phone'] }}</td>
                <td>{{ $row['active'] }}</td>
                <td><a class="my-link" href="{{ route('counselor-student', ['student_id' => $row['student_id']]) }}">{{ $row['matches'] }}</a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>
</x-app-layout>
