Dear {{ $user->first }},<br/>
<br/>Greetings from {{ config('app.name') }}!<br/>
<br/>In the past, you created a {{ config('app.name') }} profile. Since then, we've upgraded our tech platform with the aim to make your journey towards finding the perfect post-secondary education opportunity even smoother.<br/>
<br/>
NEXT STEPS:
<ul>
    <li><a href="https://app.meto-intl.org/login">Log in</a> to the new system</li>
    <li>Complete your profilea</li>
    <li>Change your password on your <a href="{{ route('student.profile') }}">basic information</a> page</li>
    </ul>
<br/>
<ul>
    <li>Log in using the following:
        <ul>
            <li>Email: {{ $user->email }}</li>
            <li>Temporary password: {{ $password }}</li>
        </ul>
    </li>
</ul>
<br/> For prompt assistance with any issues or questions, please submit a request for help <a href="https://app.meto-intl.org/contact">here</a> or email us at <a href="mailto:support@21913322.hubspot-inbox.com">support@21913322.hubspot-inbox.com</a>.<br/>
<br/> Thank you for using {{ config('app.name') }}, and we look forward to providing an improved experience.<br/>
<br/> Best regards,<br/>
<br/> The {{ config('app.name') }} Team
