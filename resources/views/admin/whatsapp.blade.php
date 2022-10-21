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
    <table id="dataTable" class="table table-striped bg-white">
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

        <tfoot>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Campaign</th>
            <th>Priority</th>
            <th>State</th>
            <th>Response</th>
        </tr>
        </tfoot>

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
        <x-dataTable></x-dataTable>

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

            <div class="mb-3">
                <x-label for="to-phone">To (phone number w/country code):</x-label>
                <x-input id="to-phone" name="to-phone" />
            </div>

            <div class="mb-3">
                <x-label for="body">Message:</x-label>
                <x-textarea id="body" name="body"></x-textarea>
            </div>

            <x-button>Send</x-button>

        </form>

    </div>

</x-app-layout>
