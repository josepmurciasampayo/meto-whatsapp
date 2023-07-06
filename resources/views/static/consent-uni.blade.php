<x-app-layout>
    <h3 class="text-center mt-5">Terms of Use for Educational Institutions</h3>
    <br/>
    <p>
        This agreement (the “Agreement”) is made between Educational Institutions (“you,” “your,” or the “Institution”) and Meto, Inc. (“Meto,” “we,” “us,” and “our”). The purpose of this document is to establish the terms and conditions that govern your access to Meto’s service (the “Service”).
    </p>
    <br/>
    <p>
        By clicking “I Agree” you confirm you have read and fully understood the terms set out in this consent form and each of the following statements is true:
    </p>
    <ul>
        <li>You understand and agree that by creating a Meto profile and/or by making use of the service, we will use your personal data for the purpose of providing the service.</li>
        <li>You understand and agree that we will only share your personal data with third parties in connection with our provision of the service (e.g., Educational Institutions, students, and our suppliers or service providers).</li>
        <li>All of the information, including personal data, you have provided us is complete, true, and correct to the best of your knowledge.</li>
    </ul>
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
