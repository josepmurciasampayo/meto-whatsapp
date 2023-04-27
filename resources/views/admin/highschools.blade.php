<x-app-layout>
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr>
            <th>Selected</th>
            <th>Verified</th>
            <th>High School</th>
            <th>Curriculum</th>
            <th>Country</th>
            <th>Students</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>-</th>
            <th>Verified</th>
            <th>High School</th>
            <th>Curriculum</th>
            <th>Country</th>
            <th>Students</th>
        </tr>
        </tfoot>

        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td class="text-center"><input class="listen" id="{{ $row['id'] }}" value="{{ $row['id'] }}" type="checkbox"></td>
            <td class="text-center"><input id="{{ $row['id'] }}" {{ ($row['verified'] == \App\Enums\General\YesNo::YES()) ? "checked" : "" }} type="checkbox"></td>
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
        <input type="hidden" name="IDs" id="IDs" value="">
        <input type="hidden" name="verifyIDs" id="verifyIDs" value="">
        @csrf
        <x-button>Merge</x-button>
        <x-button type="submit">Verify</x-button>
    </form>
    <script type="text/javascript">
        var countHS = new Set();
        var verifiedHS = new Set();


        addEventListener('input', (event) => {
            if (event.target.type === "checkbox") {
                if (event.target.classList.contains("listen")) {
                    if (event.target.checked) {
                        countHS.add(event.target.id);
                    } else {
                        countHS.remove(event.target.id);
                    }
                    document.getElementById('IDs').value = Array.from(countHS).join(',');
                } else {
                    if (event.target.checked) {
                        verifiedHS.add(event.target.id);
                    } else {
                        verifiedHS.remove(event.target.id);
                    }
                    document.getElementById('verifyIDs').value = Array.from(verifiedHS).join(',');
                }
            }
        })
    </script>
</x-app-layout>
