<x-app-layout>
    <h2 class="my-3">Please confirm that these High Schools will be merged.</h2>
    <h4>Select the one that you'd like to use as the base school for the merged school. (If you do not select any, the first one will be used.)</h4>
    <form method="POST" action="{{ route('mergeHSconfirm') }}">
        @csrf
        <input type="hidden" name="IDs" id="IDs" value="{{ $IDs }}">

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
                <td class=><input id="{{ $row->id }}" name="primary" value="{{ $row->id }}" type="radio"></td>
                <td><a href="{{ route('highschool', ['highschool_id' => $row->id]) }}"><?php echo $row->name ?></a></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>
        <x-button>Merge</x-button>
    </form>
</x-app-layout>
