<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2>Chat Text</h2>
                    <table class="table">
                        <form
                            method="POST"
                            action="/chats"
                            name="update-chats"
                            id="update-chats"
                        >
                            @csrf
                        <thead class="">
                        <tr>
                            <th>ID</th>
                            <th>Text</th>
                            <th>Capture Filter</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($messages as $message) { ?>
                        <tr class="">
                            <td><?php echo $message->id ?></td>
                            <td>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="<?php echo $message->id ?>"
                                    id="<?php echo $message->id ?>"
                                    value="<?php echo $message->text ?>"
                                >
                            </td>
                            <td><?php echo $message->capture_filter ?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                        </form>
                    </table>
                    <button
                        class="btn btn-primary"
                        type="submit"
                        form="update-chats"
                    >
                        Submit Changes
                    </button>
                </div>
                <div class="p-6">
                    <h2>Branches</h2>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>From Message</th>
                            <th>Repsonse</th>
                            <th>To Message</th>
                        </tr>
                        </thead>
                        <?php foreach ($branches as $branch) { ?>
                        <tr>
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
