<x-app-layout>
    <div class="min-h-screen mt-5 mx-2">
        <x-notes-counselor :notes="$notes"></x-notes-counselor>
        <h3 class="my-2 display-7">Student Data</h3>

        <form method="POST" action="">
            @csrf

            <div class="table-container" style="height: 50vh; overflow-y: scroll;">
                <table id="dataTable" class="table table-striped bg-white">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actively Applying</th>
                        <th>Matches</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($students as $join)
                        @php $user = $join->user @endphp
                        <tr>
                            <td><a target="_blank" class="my-link" href="{{ route('counselor-student', ['student_id' => $user->student->id]) }}">{{ $user->getFullName() }}</a></td>
                            <td>{{ $user->student->gender }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_raw }}</td>
                            <td>{{ $user->student->actively_applying }}</td>
                            <td class="text-center">{{ $user->student->connections()->count() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <x-dataTable></x-dataTable>
            </div>
        </form>
</x-app-layout>
