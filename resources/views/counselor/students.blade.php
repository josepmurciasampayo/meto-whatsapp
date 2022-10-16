<x-app-layout>
    <x-notes-counselor :notes="$notes"></x-notes-counselor>
    <h3 class="my-2">Student Data</h3>
    <table id="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Active</th>
            <th>Matches</th>
        </tr>
        </thead>
        <tr>
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
</x-app-layout>
