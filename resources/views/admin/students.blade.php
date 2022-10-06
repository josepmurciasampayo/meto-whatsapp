<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="container bg-white">

        <div class="container py-5">
            <h3 class="my-2">Raw Student Data</h3>
            <table id="data" class="table table-striped fs-6" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <th>High School</th>
                    <th>Country</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $row) { ?>
                <tr>
                    <td><?php echo $row['name'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['gender'] ?></td>
                    <td><?php echo $row['phone_raw'] ?></td>
                    <td><?php echo $row['dob'] ?></td>
                    <td><?php echo $row['school'] ?></td>
                    <td><?php echo '-' ?></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            var table = $('#data').DataTable({});
        });

    </script>
</x-app-layout>