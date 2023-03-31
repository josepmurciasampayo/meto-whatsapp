<x-app-layout>

    <div class="col-12 p-6 d-flex justify-content-center align-items-center h-100" style="height: 5rem; background-color: rgba(26, 74, 51, 0.7);">
    <strong><h1 class="text-white h-50"><i class="fas fa-home"></i> Welcome, <?php echo Auth::user()->first ?>. You are an Administrator.</h1></strong>

    </div>
        <div class="container">
            <div class="row">
            <div class="col-md-9 mt-1">
                <iframe class="card-img-top" width="600" height="635" src="https://datastudio.google.com/embed/reporting/1ac8ccdd-a501-495d-9947-e14b9c75e715/page/iqd8C" frameborder="0" style="border:0" allowfullscreen></iframe>

</div>
<div class="col-sm-3">
        <ul class="mb-5">
              <div>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-message"></i> <a href="{{ route('campaigns') }}">Chat language</a></button></li></div>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-book"></i> <a href="{{ route('comms-log') }}">WhatsApp log</a></button></li></div>
                <br/>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-question"></i> <a href="{{ route('questions') }}">Questions</a></li></div>
                  <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-question"></i> <a href="{{ route('curricula') }}">Curricula</a></li></div>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-user"></i> <a href="{{ route('students') }}">Student data</a></li></div>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-handshake"></i> <a href="{{ route('matchData') }}">Match data</a></li></div>
                <br/>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-building"></i> <a href="{{ route('universities') }}">Universities</a></li></div>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-school"></i> <a href="{{ route('highschools') }}">High Schools & Programs</a></li></div>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-chart-bar"></i> <a href="{{ route('reports') }}" target="_blank" >Reports</a></li></div>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-network-wired"></i> <a href="{{ route('workRequest') }}" target="_blank">Work Requests</a></li></div>

                <br/>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-database"></i> <a href="{{ route('databases') }}">Databases</a></li></div>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-computer"></i> <a href="{{ route('commands') }}">Commands</a></li></div>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-bank"></i> <a href="{{ route('logins') }}">User logins</a></li></div>
                <div class="mt-1 mb-1"><li><button class="btn btn-success w-100"><i class="fas fa-tachometer-alt"></i> <a href="{{ url('logs') }}">System logs</a></li></div>
                </div>
            </ul>
    </div>



</x-app-layout>
