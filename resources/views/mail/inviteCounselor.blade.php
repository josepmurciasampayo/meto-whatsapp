Hello {{ $toUser->first }},
<br/><br/>
Your colleague, {{ $fromUser->first }}, has invited you to join <a href="{{ route('home') }}">Meto</a>. Please use <a href="{{ route('password.request') }}">this link</a> to reset your password and login! (Please use the email address you received this email at; you can change it later if you'd like to.)
<br/><br/>
You can reply to this email with any questions or problems and a real person will read it and respond.
<br/><br/>
Thank you!
<img src="https://app.meto-intl.org/img/meto-logo.webp" style="height: 36px">
