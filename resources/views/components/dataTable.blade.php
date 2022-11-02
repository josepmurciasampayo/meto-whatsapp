@props(['name' => 'dataTable'])
<!--http://js-grid.com/demos/ -->
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="/css/dataTables.bootstrap5.min.css" type="text/css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css" type="text/css">
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap5.min.css" type="text/css">
<script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap5.min.css" type="text/css">
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap5.min.js"></script>
<!--
https://datatables.net/reference/option/columns.width
https://datatables.net/examples/basic_init/filter_only.html
https://datatables.net/examples/basic_init/filter_only.html
-->
<script type="text/javascript">
    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#{{ $name }} tfoot th').each( function () {
            var title = $('#{{ $name }} thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );

        // DataTable
            var table = $('#{{ $name }}').DataTable({
                paging:true,
                info:false,
                dom: 'frtiBp',
                scrollX: true,
                buttons: [
                    'copy', 'csv'
                ],
                lengthMenu:[25,50,100],
            });

        // Apply the filter
        $("#{{ $name }} tfoot input").on( 'keyup change', function () {
            table
                .column( $(this).parent().index()+':visible' )
                .search( this.value )
                .draw();
        } );
    });
</script>

<style>
    .buttons-html5 {
        background-color: #9ca3af;
    }
</style>
