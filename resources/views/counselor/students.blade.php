<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <div class="container bg-white">

        <div class="container py-5">
            <h3 class="my-2">Student Data</h3>
            <table id="data" class="table table-striped fs-6" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Date of Birth</th>
                    <?php if (Auth()->user()->role == \App\Enums\User\Role::ADMIN()) { ?>
                    <th>High School</th>
                    <th>Country</th>
                    <?php } ?>
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
                    <?php if (Auth()->user()->role == \App\Enums\User\Role::ADMIN()) { ?>
                    <td><a href="{{ route('highschool', ['id' => $row['highschool_id']]) }}"><?php echo $row['school'] ?></a></td>
                    <td><?php echo '-' ?></td>
                    <?php } ?>
                    <td><a href="{{ route('connections', ["id" => $row['student_id']]) }}"><?php echo $row['matches'] ?></a></td>
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
