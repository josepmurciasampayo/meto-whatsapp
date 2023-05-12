<x-app-layout>
    <div class="text-end my-3">
        <a href="{{ route('uni.create') }}">
            <x-button>Invite New University</x-button>
        </a>
    </div>

    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr>
            <th>University</th>
            <th>Country</th>
            <th>Existing Connections</th>
            <th>Remaining Connections</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <td>University</td>
            <td>Country</td>
            <td>Existing Connections</td>
            <td>Remaining Connections</td>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data['universities'] as $row) { ?>
        <tr>
            <td><a href="{{ route('uni', ['id' => $row['id']]) }}">{{ $row['name'] }}</a></td>
            <td>{{ $row['country'] }}</td>
            <td>{{ $data['counts'][$row['id']] ?? '-' }}</td>
            <td>{{ $row['connections'] }}</td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <x-dataTable></x-dataTable>

</x-app-layout>
