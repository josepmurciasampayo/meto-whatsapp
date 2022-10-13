<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <div class="container bg-white">
        <div class="container py-5">
            <h3 class="my-2">Student Data</h3>
            <form id="notes" name="notes" action="{{ route('saveNotes') }}" method="POST">
                @csrf
                <x-label for="notes" value="Notes" />
                <textarea class="form-control" id="notes" name="notes" rows="4">{{ $notes }}</textarea>
                <div class="text-end p-3">
                    <x-button>Update Notes</x-button>
                </div>
            </form>

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

                <script type="text/javascript">

                </script>
        </div>
    </div>
</x-app-layout>
