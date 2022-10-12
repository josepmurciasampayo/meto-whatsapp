<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
                        <li><a href="{{ route('highschools') }}">High schools</a></li>
                        <br/>
                        <li><a href="{{ route('logins') }}">User logins</a></li>
                        <li><a href="{{ url('/logs') }}">System logs</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
