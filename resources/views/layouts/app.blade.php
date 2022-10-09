<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Proza+Libre:wght@400;600;700&display=swap">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

        <style>
            body {
                font-size: 115%;
                line-height: 1.4;
            }
        </style>

    </head>

    <body class="font-sans antialiased" style="font-family: 'Proza Libre'; background-color: rgb(249, 242, 240)">
            <header style="background-color: rgb(5,23,21); color: white; min-height: 80px; height: 80px;" class="min-h-screen">
                <div class="p-6 d-flex justify-content-between">
                    <div>
                        <a href="{{ route('home') }}"><img src="/img/meto-logo.webp" style="height: 36px;"></a>
                    </div>
                    <div>
                        <a style="color:white; text-decoration: none;" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </header>

            <main>
                <div class="p-3">
                {{ $slot }}
                </div>
            </main>
    </body>
</html>
