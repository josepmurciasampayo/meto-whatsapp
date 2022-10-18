<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Meto</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Proza+Libre:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/app.css" type="text/css">
        <script src="/js/bootstrap.bundle.min.js"></script>
        <script src="/js/jquery-3.6.1.min.js"></script>

        <style>
            body {
                font-size: 115%;
                line-height: 1.4;
            }
        </style>

    </head>

    <script src="//instant.page/5.1.1" type="module" integrity="sha384-MWfCL6g1OTGsbSwfuMHc8+8J2u71/LA8dzlIN3ycajckxuZZmF+DNjdm7O6H3PSq"></script>
    <body class="font-sans antialiased" style="font-family: 'Proza Libre'; background-color: rgb(249, 242, 240)">
            <header style="background-color: rgb(5,23,21); color: white; min-height: 80px; height: 80px;" class="min-h-screen">
                <div class="p-6 d-flex justify-content-between">
                    <div>
                        <a href="{{ route('home') }}"><img src="/img/meto-logo.webp" style="height: 36px;"></a>
                    </div>
                    <div>
                        <?php if (Auth()->user()) { ?>
                        <a class="text-white mx-3" style="text-decoration: none;" href="{{ route('home') }}">Home</a>
                        <a class="text-white mx-3" style="text-decoration: none;" href="{{ route('profile') }}">Profile</a>
                        <a class="text-white mx-3" style="text-decoration: none;" href="{{ route('logout') }}">Logout</a>
                        <?php } ?>
                    </div>
                </div>
            </header>

            <main>
                <div class="p-3">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    {{ $slot }}
                        </div>
                    </div>
                </div>
            </main>
    </body>
</html>
