<x-app-layout>
    <div class="min-h-screen mt-5 mx-2 w-full">
    <div class="table-container mb-5" style="height: 100vh; overflow-y: scroll;">

    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr>
            <th>University</th>
            <th>Country</th>
            <th>Count</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>University</th>
            <th>Country</th>
            <th>Count</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data['universities'] as $row) { ?>
        <tr>
            <td><a href="{{ action([\App\Http\Controllers\Admin\getUni::class]) }}">{{ $row['name'] }}</a></td>
            <td>{{ $row['country'] }}</td>
            <td>{{ $data['counts'][$row['id']] ?? '-' }}</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
    </div>
</x-app-layout>
