<x-app-layout>

    <x-notes-counselor :notes="$notes"></x-notes-counselor>
    <h4>Summary Student Data</h4>
    <table id="summary" class="table table-striped fs-6">
        <thead>
        <tr>
            <th>Name</th>
            <th>Active</th>
            <th>Unknown</th>
            <th>Not Interested</th>
            <th>Applied</th>
            <th>Accepted</th>
            <th>Denied</th>
            <th>Enrolled</th>
            <th>Waitlisted</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($summary as $row) { ?>
        <tr>
            <td><a href="">{{ $row['name'] }}</td>
            <td>{{ $row['active'] }}</td>
            <td>{{ $row[\App\Enums\General\MatchStudentInstitution::UNKNOWN()] }}</td>
            <td>{{ $row[\App\Enums\General\MatchStudentInstitution::NOTINTERESTED()] }}</td>
            <td>{{ $row[\App\Enums\General\MatchStudentInstitution::APPLIED()] }}</td>
            <td>{{ $row[\App\Enums\General\MatchStudentInstitution::ACCEPTED()] }}</td>
            <td>{{ $row[\App\Enums\General\MatchStudentInstitution::DENIED()] }}</td>
            <td>{{ $row[\App\Enums\General\MatchStudentInstitution::ENROLLED()] }}</td>
            <td>{{ $row[\App\Enums\General\MatchStudentInstitution::WAITLISTED()] }}</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>

    <div class="my-4">
        <hr>
    </div>

    <h4 class="mt-5">Detailed Match Data</h4>
    <table id="data" class="table table-striped fs-6" style="width:100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Institution</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><a href="{{ route('counselor-student', ['student_id' => $row['student_id']]) }}"><?php echo $row['name'] ?></a></td>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['institution_name'] ?></td>
            <td><?php echo $row['status'] ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
</x-app-layout>
