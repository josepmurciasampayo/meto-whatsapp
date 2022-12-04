<x-app-layout>
    <div class="p-6 bg-white border-b border-gray-200">
        <i class="fas fa-home"></i> Welcome, <?php echo Auth::user()->first ?>. You are an Administrator.
    </div>
    <div> 
    </div>
    <div>
        <div class="container-md border">
            <div class="row">
            <div class="card col-9">
                <iframe class="card-img-top" width="600" height="450" src="https://datastudio.google.com/embed/reporting/1ac8ccdd-a501-495d-9947-e14b9c75e715/page/iqd8C" frameborder="0" style="border:0" allowfullscreen></iframe>            <div class="card-body">
    
            </div>
                    
</div>
<div class="card col-3">
    <div class="card-body">
        <ul class="mb-16">
              <div>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-message"></i> <a href="{{ route('campaigns') }}">Chat language</a></button></li></div>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-book"></i> <a href="{{ route('comms-log') }}">WhatsApp log</a></button></li></div>
                <br/>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-question"></i> <a href="{{ route('questions') }}">Questions</a></li></div>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-user"></i> <a href="{{ route('students') }}">Student data</a></li></div>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-handshake"></i> <a href="{{ route('matchData') }}">Match data</a></li></div>
                <br/>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-building"></i> <a href="{{ route('universities') }}">Universities</a></li></div>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-school"></i> <a href="{{ route('highschools') }}">High Schools & Programs</a></li></div>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-chart-bar"></i> <a href="{{ route('reports') }}" target="_blank" >Reports</a></li></div>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-network-wired"></i> <a href="{{ route('workRequest') }}" target="_blank">Work Requests</a></li></div>
    
                <br/>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-database"></i> <a href="{{ route('databases') }}">Databases</a></li></div>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-computer"></i> <a href="{{ route('commands') }}">Commands</a></li></div>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-bank"></i> <a href="{{ route('logins') }}">User logins</a></li></div>
                <div class="mt-2 mb-2"><li><button class="btn btn-success w-100"><i class="fas fa-tachometer-alt"></i> <a href="{{ url('logs') }}">System logs</a></li></div>
                </div>  
            </ul> </p>
    </div>
  </div>

</div>
</div>

    </div>
</x-app-layout>
