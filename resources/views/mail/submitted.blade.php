Hi {{ $user->first }},
<br/><br/>
Your Meto profile is 100% complete. Please remember to update your profile as new information becomes available, especially academic information such as predicted grades, national exams, or standardized test scores.
<br/><br/>
You can always log in to your account here using {{ $user->email }} and the password you set. Or, you can reset your password <a href="{{ route('forgot-password') }}">here</a>.
<br/><br/>
Have questions? Send an email to <a href="mailto:connections@meto-intl.org">connections@meto-intl.org</a>.
<br/><br/>
Best,
<br/><br/>
Meto
<br/><br/>
<img src="https://app.meto-intl.org/img/meto-logo-dark.jpeg">
