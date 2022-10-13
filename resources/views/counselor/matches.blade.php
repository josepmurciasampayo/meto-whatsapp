<x-app-layout>
    <div class="container bg-white">
        <div class="container py-5">
            <h3 class="my-2">Match Data</h3>
            <form id="notes" name="notes" action="{{ route('saveNotes') }}" method="POST">
                @csrf
                <x-label for="notes" value="Notes" />
                <textarea class="form-control" id="notes" name="notes" rows="4">{{ $notes }}</textarea>
                <div class="text-end p-3">
                    <x-button>Update Notes</x-button>
                </div>
            </form>
            <hr>
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
        </div>
    </div>
</x-app-layout>
