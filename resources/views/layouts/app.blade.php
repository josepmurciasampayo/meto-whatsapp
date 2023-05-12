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
    <link rel="stylesheet/less" type="text/css" href="/css/public.css" />


    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-3.6.1.slim.min.js"></script>
    <script src="/js/lodash.core.min.js"></script>
    <script src="/js/instantpage-5.1.1.js" type="module"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://kit.fontawesome.com/c239959cd5.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- LESS -->
    <script src="https://cdn.jsdelivr.net/npm/less"></script>

    <!-- Bootstrap date picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script type="text/javascript">
        function validateAndSubmit() {
            let message = "";
            let hasError = false;
            (Array.from(document.forms[0].elements)).forEach(element => {
                if (element.required && !element.hidden && element.value === "") {
                    hasError = true;
                    message = "Please fill out all required fields";
                }
            });
            if (document.getElementById('email') && document.getElementById('password')) {
                if (document.getElementById('email').value !== document.getElementById('email_confirmation').value) {
                    hasError = true;
                    message += (message.length == 0) ? "Email addresses do not match" : "\nEmail addresses do not match";
                }
                if (document.getElementById('password').value !== document.getElementById('password_confirmation').value) {
                    hasError = true;
                    message += (message.length == 0) ? "Passwords do not match" : "\nPasswords do not match";
                }
            }
            if (hasError) {
                alert(message);
                return;
            }
            document.forms[0].submit();
        }
    </script>

</head>

<body class="font-sans antialiased">
    <header style="background-color: rgb(5,23,21); color: white; min-height: 80px; height: 80px;" class="min-h-screen">
        <div class="p-6 d-flex justify-content-between">
            <div>
                <a href="{{ route('home') }}"><img src="/img/meto-logo.webp" style="height: 36px;"></a>
            </div>

            <div>
                <?php if (Auth()->user()) { ?>
                    @if (!(Auth()->user()->isStudent()))
                        <a class="text-white mx-3" style="text-decoration: none;" href="{{ route('profile') }}">Profile</a>
                    @endif
                    <a class="text-white mx-3" style="text-decoration: none;" href="{{ route('logout') }}">Logout</a>
                <?php } else { ?>
                    <x-button-nav href="{{route('signup') }}" class="btn btn-outline text-white-600 hover:text-gray-900 text-xs"><i class="fas fa-user-plus"></i> Create an Account</x-button-nav>
                <?php } ?>
            </div>
        </div>
    </header>

    <main>
        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{ $slot }}
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

    <!-- Axios -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Date range picker -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    </script>

</body>
</html>
