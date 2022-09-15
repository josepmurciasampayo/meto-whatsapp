<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="container bg-white">
        <table id="data" class="table table-striped fs-6" style="width:100%">
            <thead>
            <tr>
                <th>From</th>
                <th>To</th>
                <th>Name</th>
                <th>User ID</th>
                <th>Date</th>
                <th>Message</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row) { ?>
                    <?php $sent = new DateTime($row['created_at']); ?>
                    <tr>
                        <td><?php echo $row['from'] ?></td>
                        <td><?php echo $row['to'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['user_id'] ?></td>
                        <td><?php echo $sent->format('D, M j g:ia') ?></td>
                        <td><?php echo $row['body'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <hr class="my-5">

        <form method="post" action="{{ route('send-message') }}">
            @csrf
            <div style="max-width: 30%">
                <label class="form-label" for="to-phone">To (phone number w/country code):</label>
                <input class="form-control" type="text" id="to-phone" name="to-phone">
            </div>
            <div style="max-width: 80%" class="mb-3 mt-2">
                <label class="form-label" for="body">Message:</label>
                <textarea class="form-control" id="body" name="body"></textarea>

            </div>
            <button type="submit" class="btn btn-success">Send</button>
        </form>

    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#data thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#data thead');

            var table = $('#data').DataTable({
                searching: false,
                lengthMenu: [
                    [25, 100, -1],
                    [25, 100, 'All']
                ],
                orderCellsTop: true,
                fixedHeader: true,
                "columnDefs": [
                    {"width": "80px"},
                    {"width": "80px"},
                    {"width": "120px"},
                    {"width": "25px"},
                    {"width": "120px"},
                    {"width": "400px"},
                ],
                /*
                initComplete: function() {
                    var api = this.api();
                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq($(api.column(colIdx).header()).index());
                            var title = $(cell).text();
                            $(cell).html('<input type="text" placeholder="' + title + '" />');

                            // On every keypress in this input
                            $('input', $('.filters th').eq($(api.column(colIdx).header()).index()))
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
                                            this.value != '' ? regexr.replace('{search}', '(((' + this.value + ')))') : '',
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
                        */
            });
        });

    </script>
</x-app-layout>
