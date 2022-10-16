<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <h3 class="my-2">Raw Student Data</h3>
    <table id="data" class="table table-striped fs-6" style="width:100%">
        <thead>
        <tr class="text-center">
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Date of Birth</th>
            <th>High School</th>
            <th>Country</th>
            <th>Matches</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><a href=""><?php echo $row['name'] ?></a></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['gender'] ?></td>
            <td><a href=""><?php echo $row['phone_raw'] ?></a></td>
            <td><?php echo $row['dob'] ?></td>
            <td><a href="{{ route('highschool', ['id' => $row['highschool_id']]) }}"><?php echo $row['school'] ?></a></td>
            <td><?php echo '-' ?></td>
            <td class="text-center"><a href="{{ route('matches', ["id" => $row['student_id']]) }}"><?php echo $row['matches'] ?></a></td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#data thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#example thead');
            });


             var table = $('#example').DataTable({
        orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();

            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');

                    // On every keypress in this input
                    $(
                        'input',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('keyup change')
                        .on('change', function (e) {
                            // Get the search value
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})'; //$(this).parents('th').find('select').val();

                            var cursorPosition = this.selectionStart;
                            // Search the column for that value
                            api
                                .column(colIdx)
                                .search(
                                    this.value != ''
                                        ? regexr.replace('{search}', '(((' + this.value + ')))')
                                        : '',
                                    this.value != '',
                                    this.value == ''
                                )
                                .draw();
                        })
                        .on('keyup', function (e) {
                            e.stopPropagation();

                            $(this).trigger('change');
                            $(this)
                                .focus()[0]
                                .setSelectionRange(cursorPosition, cursorPosition);
                        });
                });
        },
    </script>
</x-app-layout>
