<x-app-layout>
    <div class="min-h-screen mt-5 mx-2">
        <div class="col-12 p-6 d-flex justify-content-center align-items-center h-100" style="height: 5rem; background-color: rgba(26, 74, 51, 0.7);">
            <h1 class="text-white h-50 display-7"><i class="fas fa-home"></i> Welcome, <?php echo Auth::user()->first ?>. You are an Administrator.</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-9 mt-1">
                    <iframe class="card-img-top" width="600" height="635" src="https://datastudio.google.com/embed/reporting/1ac8ccdd-a501-495d-9947-e14b9c75e715/page/iqd8C" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                <div class="col-sm-3">
                    <ul class="mb-5">
                        <div>
                            <h1 class="mt-4 text-center"><i class="fas fa-cogs"></i>System Controls</h1>

                            <br/>
                            <div class="mt-1 mb-1">
                                <x-button-nav href="{{ route('databases') }}" class="w-full">
                                    <i class="fas fa-database"></i> Databases
                                </x-button-nav>
                            </div>
                            <div class="mt-1 mb-1">
                                <x-button-nav href="{{ route('commands') }}" class="w-full">
                                    <i class="fas fa-computer"></i> Commands
                                </x-button-nav>
                            </div>
                            <div class="mt-1 mb-1">
                                <x-button-nav href="{{ route('logins') }}" class="w-full">
                                    <i class="fas fa-bank"></i> User logins
                                </x-button-nav>
                            </div>
                            <div class="mt-1 mb-1">
                                <x-button-nav href="{{ url('logs') }}" class="w-full">
                                    <i class="fas fa-tachometer-alt"></i> System logs
                                </x-button-nav>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
</x-app-layout>
