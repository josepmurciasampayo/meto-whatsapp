<x-app-layout>
    <div class="min-h-screen mt-5 mx-2 w-full">
    <h3 class="my-2">Last Login by User</h3>
    <div class="table-container mb-5" style="height: 100vh; overflow-y: scroll;">
    <table id="state" class="table table-striped bg-white">
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
    <x-dataTable name="state"></x-dataTable>

    <h3 class="my-2">All Login Events</h3>
    <table id="dataTable" class="table table-striped bg-white">
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
    <x-dataTable></x-dataTable>

</x-app-layout>
