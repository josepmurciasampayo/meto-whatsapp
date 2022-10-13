<x-app-layout>

    <div class="container bg-white">
        <h2 class="my-3">{{ $question->text }}</h2>
        <hr>
        <table id="data" class="table table-striped fs-6" >
            <thead>
            <tr>
                <th>Name</th>
                <th class="text-center">Answer</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($data as $row) { ?>
            <tr>
                <input type="hidden" name="id" id="id" value="{{ $row['id'] }}">
                <td><?php echo $row['name'] ?></td>
                <td class="text-center"><?php echo $row['text'] ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</x-app-layout>
