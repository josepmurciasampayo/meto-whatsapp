<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Welcome, {{ Auth::user()->first }}. You are a Counselor at {{ $school->name }}.
                </div>
                <div class="p-6">
                    <ul>
                        <li><a href="{{ route('counselor-students', ['highscool_id' => $school->id] ) }}">Review students</a></li>
                        <li><a href="{{ route('counselor-matches', ['highschool_id' => $school->id] ) }}">Review matches</a></li>
                        <li><a href="{{ route('highschool', ['id' => $school->id]) }}">Review school profile</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
