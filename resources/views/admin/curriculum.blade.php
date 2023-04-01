<x-app-layout>
    <div class="my-4 text-end">
        <a href="{{ route('question.create') }}"><x-button>Add Question</x-button></a>
    </div>
    <table id="dataTable" class="table table-striped bg-white">
        <thead>
        <tr class="text-center">
            <th>Screen</th>
            <th>Order</th>
            <th>Branches</th>
            <th>Format</th>
            <th>Question</th>
        </tr>
        </thead>

        <tfoot>
        <tr>
            <th>Screen</th>
            <th>Order</th>
            <th>Branches</th>
            <th>Format</th>
            <th>Question</th>
        </tr>
        </tfoot>

        <tbody>
        @foreach ($questions as $index => $question)
            <tr class="text-center">
                <td>{{ $question['order'] ?? "" }}</td>
                <td>{{ $question['screen'] ?? "" }}</td>
                <td>{{ $question['branch'] ?? "" }}</td>
                <td>{{ $question['format'] ?? "" }}</td>
                <td><a target="_blank" href="{{ route('question', ['id' => $index]) }}">{{ $question['text'] ?? "" }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <x-dataTable></x-dataTable>
</x-app-layout>
