<x-app-layout>
    <h3 class="text-center mt-5 display-7">Terms of Use for Educational Institutions</h3>
    <div class="d-flex justify-content-center">
        <div class="min-h-screen col-md-6">
            <br/>
            <p>
                This agreement (the “Agreement”) is made between Educational Institutions (“you,” “your,” or the “Institution”) and {{ config('app.name') }}, Inc. (“{{ config('app.name') }},” “we,” “us,” and “our”). The purpose of this document is to establish the terms and conditions that govern your access to {{ config('app.name') }}’s service (the “Service”).
            </p>
            <br/>
            <p>
                <strong>Conditions for using {{ config('app.name') }}’s Service</strong>
            </p>
            <p>
                By using {{ config('app.name') }}, you represent and warrant that:
            </p>
            <ul class="list-disc">
                <li>(a) you are authorized by your Institution to enter into these Terms and will use Meto’s Services solely for authorized institutional purposes, and not for personal use;</li>
                <li>(b) to the best of your ability, you will only provide accurate information about you as the user and about the Institution you represent, and you will keep this information updated;</li>
                <li>(c) you will never intentionally demonstrate interest in a student whose profile is clearly uncompetitive for your Institution (i.e. reaching out solely to increase application numbers), and</li>
                <li>(d) you will not use your access to {{ config('app.name') }}’s Service to compete with Meto or to provide information to a {{ config('app.name') }} competitor.</li>
            </ul>
            <br/>
            <p>
                You also acknowledge and agree to the following:
            </p>
            <ul class="list-disc">
                <li><strong>Third-Party Services</strong> - Our Services may allow you to access, use, or interact with websites, content, and other products and services that are not provided by {{ config('app.name') }}. When you use these other services, their own terms and privacy policies will govern your use.</li>
                <li><strong>Data Transfer</strong> - Regardless of where you use our Services, you agree that the data that we collect, store, and use will be transferred to and processed in the United States (and other countries where we have or use facilities, service providers, or partners). You acknowledge that the laws, regulations, and standards of the country in which your information is stored or processed may be different from those of your own country.</li>
                <li><strong>Data Accuracy and Completeness</strong> - The student information found on Meto is self-reported by students. So, Meto does not guarantee its accuracy or completeness. Efforts are made to ensure accuracy, and corrections are sought when needed.</li>
                <li><strong>{{ config('app.name') }} is not liable for students</strong> - {{ config('app.name') }} is merely a platform that allows institutions to efficiently connect with prospective students. Accordingly, {{ config('app.name') }} assumes no legal responsibility and is not liable for students' actions or outcomes before, during, or after their engagement with you.</li>
                <li><strong>Permission to Contact You</strong> - {{ config('app.name') }} and its third-party providers may use your contact information for electronic communications, including emails and phone calls.</li>
            </ul>
            <br/>
            <p>
                <strong>Your access to and use of student data</strong>
            </p>
            <br/>
            <p>
                Students provide their information to {{ config('app.name') }} with the intention of having {{ config('app.name') }} share their information with educational institutions like yours.
            </p>
            <br/>
            <p>
                However, it is of the utmost importance to us that students’ privacy is protected in accordance with the standards set forth by the General Data Protection Regulations (“GDPR”) and any additional applicable national data protection laws.
            </p>
            <br/>
            <p>
                By using {{ config('app.name') }}’s service, you agree:
            </p>
            <ul class="list-disc">
                <li><strong>Not to share data with third parties.</strong> You shall treat all student data obtained from {{ config('app.name') }} as confidential and not disclose or transfer it to any third party without Meto's prior written consent.</li>
                <li><strong>To adhere to industry-standard data security measures.</strong> You shall adhere to industry-standard measures in the protection of student data that you obtained via {{ config('app.name') }}. This includes restricting access to student data to only the staff members who need access as well as ensuring that student data is accessed through secure, private internet networks.</li>
                <li><strong>Not to keep student data for longer than is necessary.</strong> You shall not retain student data obtained from {{ config('app.name') }} longer than necessary for its intended purpose.</li>
                <li><strong>To cooperate with us to fulfill our obligations to the students.</strong> You shall cooperate with {{ config('app.name') }} to enable students to activate their rights to access, rectify, erase, and object to the processing of their personal data.</li>
                <li><strong>To let us know if a breach occurs.</strong> You shall notify Meto promptly in the event of a security breach or unauthorized access to student data that you obtained from {{ config('app.name') }}.</li>
            </ul>
            <br/>
            <p>
                By accepting these terms, the Educational Institution agrees to comply with the above provisions and use student data obtained from {{ config('app.name') }} accordingly.
            </p>
            <br/>
            <p>
                This Agreement shall remain in effect until terminated by either party. Either party may terminate this Agreement by giving 60 days written notice to the other party.
            </p>
            <br/>
            <p>
                This Agreement shall be governed by and construed in accordance with the laws of the District of Columbia in the United States of America.
            </p>
            <br/>
            <p>
                <strong>Contact Information</strong>
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
