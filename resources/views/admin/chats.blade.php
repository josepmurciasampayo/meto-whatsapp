<x-app-layout>
    <div class="min-h-screen mt-5 mx-2"> 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="ml-4 pt-6">
                    <h2>Chat Text</h2>
                    <table class="table">
                        <form method="POST" action="/chats" name="update-chats" id="update-chats">
                            @csrf
                        <thead>
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Text</th>
                            <th>Capture Filter</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($messages as $message) { ?>
                        <tr class="text-center">
                            <td><?php echo $message->id ?></td>
                            <td>
                                <x-input type="text" name="$message->id" :value="$message->text" />
                            </td>
                            <td><?php echo $message->capture_filter ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                        </form>
                    </table>
                </div>
                <x-button class="ml-4" form="update-chats">Submit Changes</x-button>

                <div class="p-6 mt-4">
                    <h2>Branches</h2>
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th>From Message</th>
                            <th>Repsonse</th>
                            <th>To Message</th>
                        </tr>
                        </thead>
                        <?php foreach ($branches as $branch) { ?>
                        <tr class="text-center">
                            <td><?php echo $branch->from_message_id ?></td>
                            <td><?php echo $branch->response ?></td>
                            <td><?php echo $branch->to_message_id ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
