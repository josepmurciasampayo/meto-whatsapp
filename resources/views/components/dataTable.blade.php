<script src="/js/jquery.dataTables.min.js"></script>
<script src="/js/dataTables.bootstrap5.min.js"></script>
<link rel="stylesheet" href="/css/dataTables.bootstrap5.min.css" type="text/css">

<script type="text/javascript">
    $(document).ready(function () {
        // Setup - add a text input to each footer cell
        $('#dataTable tfoot th').each( function () {
            var title = $('#table thead th').eq( $(this).index() ).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
        } );

        // DataTable
            var table = $('#dataTable').DataTable({
                paging:true,
                info:false,
                lengthMenu:[25,50,100],
            });

        // Apply the filter
        $("#dataTable tfoot input").on( 'keyup change', function () {
            table
                .column( $(this).parent().index()+':visible' )
                .search( this.value )
                .draw();
        } );
    });
</script>
