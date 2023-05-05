<x-app-layout>
    <div class="min-h-screen mt-5 mx-2">
    <x-notes-counselor :notes="$notes"></x-notes-counselor>
    <h1 class="display-7 my-5">Outcome Data Summary</h1>
    <div class="table-container mb-5" style="height: 400px; overflow-y: scroll;">
    <table id="summary" class="table table-striped bg-white">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actively Applying</th>
            <th>Matched</th>
            <th>Not Interested</th>
            <th>Applied</th>
            <th>Accepted</th>
            <th>Denied</th>
            <th>Enrolled</th>
            <th>Waitlisted</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Name</th>
            <th>Actively Applying</th>
            <th>Matched</th>
            <th>Not Interested</th>
            <th>Applied</th>
            <th>Accepted</th>
            <th>Denied</th>
            <th>Enrolled</th>
            <th>Waitlisted</th>
        </tr>
        </tfoot>

        <tbody>
        
        <?php foreach ($summary as $row) { ?>
        <tr>
            <td><a class="my-link" href="{{ route('counselor-student', ['student_id' => $row['student_id']]) }}">{{ $row['name'] }}</a></td>
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
    <x-dataTable name="summary"></x-dataTable>


</div>

<h1 class="display-7 my-5">Match Data Summary</h1>

    <div class="table-container mb-5" style="height: 400px; overflow-y: scroll;">

   

    <table id="data" class="table table-striped bg-white">
        <thead>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Institution</th>
            <th>Status</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Name</th>
            <th>Date</th>
            <th>Institution</th>
            <th>Status</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><a class="my-link" href="{{ route('counselor-student', ['student_id' => $row['student_id']]) }}"><?php echo $row['name'] ?></a></td>
            <td><?php echo $row['date'] ?></td>
            <td><?php echo $row['institution_name'] ?></td>
            <td><?php echo $row['status'] ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <x-dataTable name="data"></x-dataTable>
    
    </div>
</x-app-layout>
