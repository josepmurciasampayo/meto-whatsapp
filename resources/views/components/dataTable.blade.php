@props(['name' => 'dataTable'])
<!--http://js-grid.com/demos/ -->
<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="/css/dataTables.bootstrap5.min.css" type="text/css">
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
