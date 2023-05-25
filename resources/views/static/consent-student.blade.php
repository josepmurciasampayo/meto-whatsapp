<x-app-layout>
    <h3 class="text-center mt-5">Student Consent Form</h3>
    <br/><br/>
    <p>
        Meto Incorporated is a non-profit organization with its offices at 724 F St NE, Washington, DC 20002 (EIN No: 84-2456429) ("Meto", “we”, “us” and “our”).
        Meto has developed an online “meeting place” (the “service”) that enables students (hereafter referred to as “you" and “your”) to create unique profiles in order to access and connect with universities and other educational institutions (hereafter referred to as “Educational Institutions").
        In order to provide you with the service, we need to process certain personal data (e.g., your name, email address and educational history). We process such data in accordance with our <a href="{{ route('privacy') }}">Privacy Policy</a>. Meto is the data controller of your personal data processed in connection with the service.
        By clicking “I agree” you confirm you have read and fully understood the terms set out in this consent form and each of the following statements are true:
    </p>
    <br/><br/>
    <ul>
        <li>You understand and agree that by creating a Meto profile and/or by making use of the service, we will use your personal data for the purpose of providing the service.</li>
        <li>You understand and agree that we will only share your personal data with third parties in connection with our provision of the service (e.g., Educational Institutions and our suppliers or service providers).</li>
        <li>All of the information, including personal data, you have provided us is complete, true and correct to the best of your knowledge.</li>
    </ul>
    <br/>
    <p class="fw-bold">PARENTAL CONSENT (UNDER 16)</p>
    <p>
        For students under the age of 16, or students unable to consent for other reasons, your parent or legal guardian must provide their consent to the terms above. Once their consent is obtained, you may proceed.
    </p>
    @if (Auth::user() && !Auth::user()->consent())
        <form action="{{ route('saveConsent') }}" method="POST">
            @csrf
            <input type="hidden" name="consent" id="consent" value="{{ \App\Enums\General\YesNo::YES() }}">
            <div class="text-center mt-3">
                <x-button>I Agree</x-button>
            </div>
        </form>
    @endif
</x-app-layout>
