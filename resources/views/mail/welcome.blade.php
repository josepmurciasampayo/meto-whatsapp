Hi {{ $user->first }},
<br/><br/>
Thank you for beginning your {{ config('app.name') }} profile! Please complete your profile fully to ensure you get the best results from using Meto.
<br/><br/>
You can always log in to your account <a href="{{ route('login') }}">here</a> using {{ $user->email }} and the password you set. Or, you can reset your password <a href="{{ route('password.request') }}">here</a>.
<br/><br/>
Thank you!
<br/><br/>
<img src="https://app.meto-intl.org/img/meto-logo-dark.jpeg">
