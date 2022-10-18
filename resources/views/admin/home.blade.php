<x-app-layout>
    <div class="p-6 bg-white border-b border-gray-200">
        Welcome, <?php echo Auth::user()->first ?>. You are an Administrator.
    </div>
    <div class="p-6">
        <ul>
            <li><a href="{{ route('campaigns') }}">Chat language</a></li>
            <li><a href="{{ route('comms-log') }}">WhatsApp log</a></li>
            <br/>
            <li><a href="{{ route('questions') }}">Questions</a></li>
            <li><a href="{{ route('students') }}">Student data</a></li>
            <li><a href="{{ route('matchData') }}">Match data</a></li>
            <br/>
            <li><a href="{{ route('universities') }}">Universities</a></li>
            <li><a href="{{ route('highschools') }}">High schools and Access Programs</a></li>
            <br/>
            <li><a href="{{ route('logins') }}">User logins</a></li>
            <li><a href="{{ url('/logs') }}">System logs</a></li>
        </ul>
    </div>
</x-app-layout>
