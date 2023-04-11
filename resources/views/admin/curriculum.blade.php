<x-app-layout>
    <div class="my-4">
        <div class="text-start">
            <h3>{{ $curriculum }}</h3>
        </div>
        <div class="text-end">
            <a href="{{ route('question.create') }}"><x-button>Add Question</x-button></a>
        </div>
        <a href="{{ route('curricula') }}">Back to Curricula</a>
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

        <tbody>
        @foreach ($questions as $id => $question)
            @if (isset($question['screen']))
                @php $background = $screens[$question['screen']] ? "" : "#ff6961"; @endphp
            @else
                @php $background = ""; @endphp
            @endif
            <tr class="text-center" style="background-color: {{ $background }}">
                <td>{{ $question['screen'] ?? "" }}</td>
                <td>{{ $question['order'] ?? "" }}</td>
                <td>{{ $question['branch'] ?? "" }}</td>
                <td>{{ $question['format'] ?? "" }}</td>
                <td><a target="_blank" href="{{ route('question', ['id' => $id]) }}">{{ $question['text'] ?? "" }}</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
