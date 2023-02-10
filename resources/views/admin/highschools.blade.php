<x-app-layout>
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr>
            <th>Selected</th>
            <th>High School</th>
            <th>Curriculum</th>
            <th>Country</th>
            <th>Students</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>-</th>
            <th>High School</th>
            <th>Curriculum</th>
            <th>Country</th>
            <th>Students</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td class="text-center"><input id="{{ $row['id'] }}" value="{{ $row['id'] }}" type="checkbox"></td>
            <td><a href="{{ route('highschool', ['highschool_id' => $row['id']]) }}"><?php echo $row['name'] ?></a></td>
            <td><?php echo $row['curriculum'] ?></td>
            <td><?php echo $row['country'] ?></td>
            <td class="text-center"><a href="{{ route('students', ['highschool_id' => $row['id']]) }}"><?php echo $row['students'] ?></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
    <form method="POST" action="{{ route('mergeHS') }}">
        @csrf
        <input type="hidden" name="IDs" id="IDs" value="">
        <x-button>Merge</x-button>
    </form>
    <script type="text/javascript">
        var countHS = new Set();

        function trackID(id) {
            document.getElementById('IDs').value = Array.from(countHS).join(',');
        }

        addEventListener('input', (event) => {
            if (event.target.type === "checkbox") {
                if (event.target.checked) {
                    countHS.add(event.target.id);
                } else {
                    countHS.remove(event.target.id);
                }
                trackID(event.target.id);
            }
        })
    </script>
</x-app-layout>
