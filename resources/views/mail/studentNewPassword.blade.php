Dear {{ $user->first }},<br/>
<br/>Greetings from {{ config('app.name') }}!<br/>
<br/>In the past, you created a {{ config('app.name') }} profile. Since then, we've upgraded our tech platform with the aim to make your journey towards finding the perfect post-secondary education opportunity even smoother. Exciting times are ahead!<br/>
<br/>
NEXT STEPS:
<ul>
    <li><a href="https://app.meto-intl.org/login">Log in</a> and verify the accuracy of your information</li>
    <li>Complete your profile</li>
    <li>visit your basic information page to update basic details like your WhatsApp number and change your password</li>
    </ul>
<br/>
GET STARTED:
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
