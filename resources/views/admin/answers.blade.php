<x-app-layout>
    <h2 class="my-3">{{ $question->text }}</h2>
    <table id="dataTable" class="table table-striped bg-white" >
        <thead>
        <tr>
            <th>Name</th>
            <th class="text-center">Answer</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Name</th>
            <th class="text-center">Answer</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <input type="hidden" name="id" id="id" value="{{ $row['id'] }}">
            <td><a href="{{ route('counselor-student', ['student_id' => $row['student_id']]) }}"><?php echo $row['name'] ?></a></td>
            <td class="text-center"><?php echo $row['text'] ?></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
</x-app-layout>
