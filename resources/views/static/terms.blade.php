<x-app-layout>
    <div class="bg-white p-4">
        <div class="text-center mb-4">
            <h2>TERMS OF USE</h2>
            <p>Last Updated: October 20, 2022</p>
        </div>
        <style>
            p {
                margin-top: 15px;
                margin-bottom: 15px;
            }
            h3 {
                font-weight: bold;
            }
        </style>
        <p class="mb-4">Please read these terms of use ("terms of use") carefully before using {{ config('app.name') }} ("service") operated by {{ config('app.name') }} Inc ("us", 'we", "our").</p>
        <h3>CONDITIONS OF USE</h3>
        <p>By using this service, you certify that you have read and reviewed this Agreement and that you agree to comply with its terms. If you do not want to be bound by the terms of this Agreement, you are advised to leave the website accordingly. {{ config('app.name') }} only grants use and access of this website, its products, and its services to those who have accepted its terms.</p>
        <h3>PRIVACY POLICY</h3>
        <p>Before you continue using our website, we advise you to read our <a href="{{ route('privacy') }}">privacy policy</a> regarding our user data collection. It will help you better understand our practices.</p>
        <h3>AGE RESTRICTION</h3>
        <p>You must be at least 18 (eighteen) years of age before you can use this website. By using this website, you warrant that you are at least 18 years of age and you may legally adhere to this Agreement. {{ config('app.name') }} assumes no responsibility for liabilities related to age misrepresentation.</p>
        <h3>PERMISSION BY PARENT OR GUARDIAN</h3>
        <p>If you are under 18, you represent that you have your parent or guardian’s permission to use the Service. Please have them read this Agreement with you.</p>
        <p>If you are a parent or legal guardian of a user under the age of 18, by allowing your child to use the Service, you are subject to the terms of this Agreement and responsible for your child’s activity on the Service.</p>
        <p>You have the right to limit or stop any of this at any time by emailing <a href="mailto:securityandprivacy@meto-intl.org">securityandprivacy@meto-intl.org</a>.</p>
        <h3>INTELLECTUAL PROPERTY</h3>
        <p>You agree that all materials, products, and services provided on this website are the property of {{ config('app.name') }} Inc, its affiliates, directors, officers, employees, agents, suppliers, or licensors including all copyrights, trade secrets, trademarks, patents, and other intellectual property. You also agree that you will not reproduce or redistribute the {{ config('app.name') }}’s intellectual property in any way, including electronic, digital, or new trademark registrations.</p>
        <p>You grant {{ config('app.name') }} a royalty-free and non-exclusive license to display, use, copy, transmit, and broadcast the content you upload and publish in accordance with its privacy policy. For issues regarding intellectual property claims, you should contact the company in order to come to an agreement.</p>
        <h3>USER ACCOUNTS</h3>
        <p>As a user of this website and its associated application, you may be asked to register with us and provide private information. You are responsible for ensuring the accuracy of this information, and you are responsible for maintaining the safety and security of your identifying information. You are also responsible for all activities that occur under your account or password.</p>
        <p>If you think there are any possible issues regarding the security of your account on the website, inform us immediately at <a href="mailto:securityandprivacy@meto-intl.org">securityandprivacy@meto-intl.org</a> so we may address it accordingly.</p>
        <p>We reserve all rights to terminate accounts, edit or remove content and cancel requests in their sole discretion.</p>
        <h3>APPLICABLE LAW</h3>
        <p>By visiting this website, you agree that the laws of the District of Columbia in United States, without regard to principles of conflict laws, will govern these terms and conditions, or any dispute of any sort that might come between {{ config('app.name') }} and you, or its business partners and associates.</p>
        <h3>DISPUTES</h3>
        <p>Any dispute related in any way to your visit to this website or to services provided from us shall be arbitrated by state or federal court in the District of Columbia in United States, and you consent to exclusive jurisdiction and venue of such courts.</p>
        <h3>INDEMNIFICATION</h3>
        <p>You agree to indemnify {{ config('app.name') }} and its affiliates and hold {{ config('app.name') }} harmless against legal claims and demands that may arise from your use or misuse of our services. We reserve the right to select our own legal counsel.</p>
        <h3>LIMITATION ON LIABILITY</h3>
        <p>{{ config('app.name') }} is not liable for any damages that may occur to you as a result of your misuse of our website and associated application.</p>
        <p>{{ config('app.name') }} reserves the right to edit, modify, and change this Agreement any time. We shall let our users know of these changes through electronic mail or by alerts through our application. This Agreement is an understanding between Meto and the user, and this supersedes and replaces all prior agreements regarding the use of this website and associated application.</p>
    </div>
    @if (Auth::user() && Auth::user()->terms == 0)
        <form action="{{ route('saveTerms') }}" method="POST">
            @csrf
            <input type="hidden" name="terms" id="terms" value="1">
            <div class="text-center">
                <x-button>I Agree</x-button>
            </div>
        </form>
    @endif
</x-app-layout>
