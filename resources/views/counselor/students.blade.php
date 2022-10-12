<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.umd.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <div class="container bg-white">
        <div class="container py-5">
            <h3 class="my-2">Student Data</h3>
            <div id="table-wrapper"></div>
                <script type="text/javascript">
                    new gridjs.Grid({
                        columns: ['Name', 'Email', 'Gender', 'Phone', 'Date of Birth', 'Matches'],
                        data: [
                            <?php echo $data ?>
                        ],
                    }).render(document.getElementById('table-wrapper'));
                </script>
        </div>

    </div>


    <script type="text/javascript">
        // $(document).ready(function () { var table = $('#data').DataTable({}); });
    </script>
</x-app-layout>
