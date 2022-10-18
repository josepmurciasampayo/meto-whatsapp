Hello {{ $toUser->first }},
<br/><br/>
Your colleague, {{ $fromUser->first }}, has invited you to join the {{ $school }} <a href="{{ route('home') }}">Meto</a> account. Please use <a href="{{ route('password.request') }}">this link</a> to reset your password and login! Please use {{ $toUser->email }} the first time you login. You can change it later if you'd like to.
<br/><br/>
Welcome to Meto. You can reply to this email with any questions or problems and a real person will read it and respond.
<br/><br/>
Thank you!
<img src="https://app.meto-intl.org/img/meto-logo-dark.jpeg">
