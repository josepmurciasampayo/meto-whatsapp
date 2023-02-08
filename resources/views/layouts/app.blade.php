<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Meto</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=proza-libre:400,600,800" rel="stylesheet" />
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/css/app.css" type="text/css">

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.6.1.slim.min.js"></script>
    <script src="/js/lodash.core.min.js"></script>
    <script src="/js/instantpage-5.1.1.js" type="module"></script>

    <style>
        body {
            font-size: 115%;
            line-height: 1.4;
            font-family: 'Proza Libre', sans-serif;
            background-color: rgb(249, 242, 240);
        }
    </style>

</head>


<body class="font-sans antialiased">
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

    <footer class="py-3 my-4 bg-black">
        <ul class="nav justify-content-center pb-3 mb-3">
            <li><a href="{{ route('terms') }}" class="nav-link text-white mx-3">Terms of Use</a></li>
            <li><a href="{{ route('privacy-policy') }}" class="nav-link text-white mx-3">Privacy Policy</a></li>
            <li><a href="{{ route('contact') }}" class="nav-link text-white mx-3">Contact Us</a></li>

        </ul>
    </footer>

</body>

</html>
