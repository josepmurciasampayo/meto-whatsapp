<x-app-layout>
    <div class="p-6 bg-white border-b border-gray-200">
        Welcome, {{ Auth::user()->first }}. You are a Counselor at {{ $school->name }}.
        <p class="my-2">{{ $summaryCounts['active'] }} active students out of {{ $summaryCounts['total'] }} total</p>
    </div>
    <div class="p-6">
        <x-notes-counselor :notes="$notes"></x-notes-counselor>
        <ul>
            <li><a href="{{ route('counselor-students', ['highscool_id' => $school->id] ) }}">My students</a></li>
            <li><a href="{{ route('counselor-matches', ['highschool_id' => $school->id] ) }}">Review matches</a></li>
            <?php if (Auth()->user()->isSchoolAdmin()) { ?>
                <br/>
                <li><a href="{{ route('highschool', ['id' => $school->id]) }}">Institution profile</a></li>
                <li><a href="{{ route('invite', ['highschool_id' => $school->id]) }}">Invite new counselors</a></li>
            <?php } ?>
        </ul>
    </div>
</x-app-layout>
