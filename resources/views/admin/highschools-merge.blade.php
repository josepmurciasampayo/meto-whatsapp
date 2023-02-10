<x-app-layout>
    <h2>Please confirm that these High Schools will be merged.</h2>
    <h4>Select the one that you'd like to use as the base school for the merged school.</h4>
    <h4>If you do not select any, the first one will be used.</h4>
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr>
            <th>Primary</th>
            <th>High School</th>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td class="text-center"><input id="{{ $row->id }}" value="{{ $row->id }}" type="checkbox"></td>
            <td><a href="{{ route('highschool', ['highschool_id' => $row->id]) }}"><?php echo $row->name ?></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <form method="POST" action="{{ route('mergeHSconfirm') }}">
        @csrf
        <input type="hidden" name="IDs" id="IDs" value="{{ $IDs }}">
        <input type="hidden" name="primary" id="primary" value="">
        <x-button>Merge</x-button>
    </form>
    <script type="text/javascript">
        addEventListener('input', (event) => {
            if (event.target.type === "checkbox") {
                if (event.target.checked) {
                    document.getElementById('primary').value = event.target.id;
                }
            }
        })
    </script>
</x-app-layout>
