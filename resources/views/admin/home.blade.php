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
            <li><a href="{{ route('students') }}">Students</a></li>
            <li><a href="{{ route('matchData') }}">Matches</a></li>
            <br/>
            <li><a href="{{ route('universities') }}">Universities</a></li>
            <li><a href="{{ route('highschools') }}">High Schools and Access Programs</a></li>
            <br/>
            <li><a href="{{ route('commands') }}">Commands</a></li>
            <li><a href="{{ route('databases') }}">Databases</a></li>
            <li><a href="{{ route('logins') }}">User Logins</a></li>
            <li><a href="{{ url('logs') }}">System Logs</a></li>
        </ul>
    </div>
</x-app-layout>
