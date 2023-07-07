<x-app-layout>
    <h3 class="text-center mt-5">Terms of Use for Educational Institutions</h3>
    <div class="d-flex justify-content-center">
        <div class="min-h-screen col-md-6">
    <br/>
    <p>
        This agreement (the “Agreement”) is made between Educational Institutions (“you,” “your,” or the “Institution”) and Meto, Inc. (“Meto,” “we,” “us,” and “our”). The purpose of this document is to establish the terms and conditions that govern your access to Meto’s service (the “Service”).
    </p>
    <br/>
    <p>
        <strong>Conditions for using Meto’s Service</strong>
    </p>
    <p>
        By using Meto, you represent and warrant that:
    </p>
    <ul class="list-disc">
        <li>(a) you are authorized by your Institution to enter into these Terms and will use Meto’s Services solely for authorized institutional purposes, and not for personal use;</li>
        <li>(b) to the best of your ability, you will only provide accurate information about you as the user and about the Institution you represent, and you will keep this information updated;</li>
        <li>(c) you will never intentionally demonstrate interest in a student whose profile is clearly uncompetitive for your Institution (i.e. reaching out solely to increase application numbers), and</li>
        <li>(d) you will not use your access to Meto’s Service to compete with Meto or to provide information to a Meto competitor.</li>
    </ul>
    <br/>
    <p>
    You also acknowledge and agree to the following:
    </p>
    <ul class="list-disc">
        <li>Third-Party Services. Our Services may allow you to access, use, or interact with websites, content, and other products and services that are not provided by Meto. When you use these other services, their own terms and privacy policies will govern your use.</li>
        <li>Data Transfer. Regardless of where you use our Services, you agree that the data that we collect, store, and use will be transferred to and processed in the United States (and other countries where we have or use facilities, service providers, or partners). You acknowledge that the laws, regulations, and standards of the country in which your information is stored or processed may be different from those of your own country.</li>
        <li>Data Accuracy and Completeness: The student information found on Meto is self-reported by students. So, Meto does not guarantee its accuracy or completeness. Efforts are made to ensure accuracy, and corrections are sought when needed.</li>
        <li>Meto is not liable for students. Meto is merely a platform that allows institutions to efficiently connect with prospective students. Accordingly, Meto assumes no legal responsibility and is not liable for students' actions or outcomes before, during, or after their engagement with you.</li>
        <li>Permission to Contact You. Meto and its third-party providers may use your contact information for electronic communications, including emails and phone calls.</li>
    </ul>
    <br/>
    <p>
        <strong>Your access to and use of student data</strong>
    </p>
    <p>
    Students provide their information to Meto Inc (“Meto,” ) with the intention of having Meto share their information with educational institutions like yours.
    </p>
    <p>
    However, it is of the utmost importance to us that students’ privacy is protected in accordance with the standards set forth by the General Data Protection Regulations (“GDPR”) and any additional applicable national data protection laws.
    </p>
    <p>
    By using Meto’s service, you agree:
    </p>
    <ul class="list-disc">
        <li>Not to share data with third parties. You shall treat all student data obtained from Meto as confidential and not disclose or transfer it to any third party without Meto's prior written consent.</li>
        <li>To adhere to industry-standard data security measures. You shall adhere to industry-standard measures in the protection of student data that you obtained via Meto. This includes restricting access to student data to only the staff members who need access as well as ensuring that student data is accessed through secure, private internet networks.</li>
        <li>Not to keep student data for longer than is necessary. You shall not retain student data obtained from Meto longer than necessary for its intended purpose.</li>
        <li>To cooperate with us to fulfill our obligations to the students. You shall cooperate with Meto to enable students to activate their rights to access, rectify, erase, and object to the processing of their personal data.</li>
        <li>To let us know if a breach occurs. You shall notify Meto promptly in the event of a security breach or unauthorized access to student data that you obtained from Meto.</li>
    </ul>
    <br/>
    <p>
    By accepting these terms, the Educational Institution agrees to comply with the above provisions and use student data obtained from Meto accordingly.
    </p>
    <p>
        This Agreement shall remain in effect until terminated by either party. Either party may terminate this Agreement by giving 60 days written notice to the other party.
    </p>
    <p>
    This Agreement shall be governed by and construed in accordance with the laws of the District of Columbia in the United States of America.
    </p>
    <p>
    Contact Information
    </p>
    <p>
    If you have any questions about our data processing practices or how we process your personal data, please contact us at <a href="mailto:securityandprivacy@meto-intl.org">securityandprivacy@meto-intl.org</a>.
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
        </div>
    </div>
</x-app-layout>
