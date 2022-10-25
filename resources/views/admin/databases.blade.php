<x-app-layout>
    <h2>Database Counts</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Entity</th>
            <th>Local ({{ App::environment() }})</th>
            <th>Google DB</th>
            <th>Google Imported</th>
        </tr>
        </thead>

        <tbody>
        <tr>
            <td>Students</td>
            <td>{{ $student_local }}</td>
            <td>{{ $student_google }}</td>
            <td>{{ $student_imported }}</td>
        </tr>
        <tr>
            <td>Universities</td>
            <td>{{ $uni_local }}</td>
            <td>{{ $uni_google }}</td>
            <td>{{ $uni_imported }}</td>
        </tr>
        <tr>
            <td>High Schools</td>
            <td>{{ $hs_local }}</td>
            <td>{{ $hs_google }}</td>
            <td>{{ $hs_imported }}</td>
        </tr>
        <tr>
            <td>Matches</td>
            <td>{{ $match_local }}</td>
            <td>{{ $match_google }}</td>
            <td>{{ $match_imported }}</td>
        </tr>
        <tr>
            <td>Answers</td>
            <td>{{ $answer_local }}</td>
            <td>{{ $answer_google }}</td>
            <td>{{ $answer_imported }}</td>
        </tr>
        </tbody>
    </table>
</x-app-layout>
