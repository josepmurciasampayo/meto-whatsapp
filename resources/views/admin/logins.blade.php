<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="container bg-white">

        <div class="container py-5">
            <h3 class="my-2">Last Login by User</h3>
            <table id="state" class="table table-striped fs-6" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Login Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($lastLogins as $row) { ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['role'] ?></td>
                    <td><?php echo $row['event_time'] ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

        <div class="container py-5">
            <h3 class="my-2">All Login Events</h3>
            <table id="data" class="table table-striped fs-6" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Login Event</th>
                    <th>Login Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $row) { ?>
                <?php $time = new DateTime($row['event_time']); ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['role'] ?></td>
                    <td><?php echo $row['type'] ?></td>
                    <td><?php echo $time->format('D, M j g:ia') ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            var state = $('#state').DataTable({});

            var table = $('#data').DataTable({
                searching: false,
                lengthMenu: [
                    [25, 100, -1],
                    [25, 100, 'All']
                ],
                orderCellsTop: true,
                fixedHeader: true,

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
