<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600;700&display=swap">
        <link rel="stylesheet" type="text/css" href="/css/app.css">
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <script src="/js/app.js" type="text/javascript"></script>
    </head>

    <body class="font-sans antialiased" style="font-family: 'Roboto Thin';">
            <header style="background-color: rgb(5,23,21); color: white; min-height: 80px; height: 80px;" class="min-h-screen">
                <div class="p-6">
                    <img src="/img/meto-logo.webp" style="width: 5%;">
                </div>
            </header>

            <main>
                {{ $slot }}
            </main>
    </body>
</html>
