<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Welcome, {{ Auth::user()->first }}. You are a Counselor at {{ $school->name }}.
                    <p class="my-3">{{ $summaryCounts['active'] }} active students out of {{ $summaryCounts['total'] }} total</p>
                </div>
                <div class="p-6">
                    <form id="notes" name="notes" action="{{ route('saveNotes') }}" method="POST">
                        @csrf
                        <x-label for="notes" value="Notes" />
                        <textarea class="form-control" id="notes" name="notes" rows="4">{{ $notes }}</textarea>
                        <div class="text-end p-3">
                            <x-button>Update Notes</x-button>
                        </div>
                    </form>
                    <ul>
                        <li><a href="{{ route('counselor-students', ['highscool_id' => $school->id] ) }}">Review students</a></li>
                        <li><a href="{{ route('counselor-matches', ['highschool_id' => $school->id] ) }}">Review matches</a></li>
                        <?php if (Auth()->user()->isSchoolAdmin()) { ?>
                            <br/>
                            <li><a href="{{ route('highschool', ['id' => $school->id]) }}">Review school profile</a></li>
                            <li><a href="{{ route('sendInvite') }}">Invite new counselors</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
