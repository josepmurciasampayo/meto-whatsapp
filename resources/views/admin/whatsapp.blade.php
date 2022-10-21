<x-app-layout>
    @env('local')
    <div class="my-5 py-3 mx-3">
        <form method="post" action="{{ route('startChatbot') }}">
            @csrf
            <x-button>Start Chatbot</x-button>
        </form>

        <form method="post" action="{{ route('resetChatbot') }}">
            @csrf
            <x-button-secondary>Reset Chatbot</x-button-secondary>
        </form>
    </div>
    @endenv

        <h3 class="my-2">Messaging State Summary</h3>
        <table id="state" class="table table-striped fs-6">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Campaign</th>
                <th>Priority</th>
                <th>State</th>
                <th>Response</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($state as $row) { ?>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['campaign'] ?></td>
                <td><?php echo $row['priority'] ?></td>
                <td><?php echo $row['state'] ?></td>
                <td><?php echo $row['response'] ?></td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

        <div class="container py-5">
            <h3 class="my-2">WhatsApp Messaging Log</h3>
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
        </div>

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

</x-app-layout>
