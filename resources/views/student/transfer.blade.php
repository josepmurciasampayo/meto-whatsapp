<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mt-2">

        <x-image-with-text
            image-src="/img/Meto-background.webp"
            alt=""
            text="Transfers and Graduate Students" />
        <p class="mt-2 text-center">At the moment, Meto doesn't provide active support to transfer or graduate students. To receive updates on potential opportunities, please complete the form below, and we'll get in touch as they arise.</p>

        <div class="w-75 lg:max-w-md mt-4 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form id="transferForm" method="POST" action="{{ route('student.transfer') }}">
                @csrf
                <x-inputs.text name="first" label="First/Given Name"></x-inputs.text>
                <x-inputs.text name="middle" label="Middle Name"></x-inputs.text>
                <x-inputs.text name="last" label="Last/Family Name"></x-inputs.text>
                <x-inputs.email name="email" label="Email Address"></x-inputs.email>
                <x-inputs.radio name="gender" label="Gender" :options="['male' => 'Male', 'female' => 'Female', 'prefer_not_to_say' => 'I prefer not to say']"></x-inputs.radio>

                <x-inputs.country name="country" label="Country"></x-inputs.country>
                <x-inputs.phone name="phone" label="Phone Number"></x-inputs.phone>
                <x-inputs.radio name="interest" label="Interested in:" :options="['transfer_opportunities' => 'Transfer opportunities', 'graduate_opportunities' => 'Graduate opportunities']"></x-inputs.radio>

                <x-button-icon type="submit" icon="fa fa-share-square" text="Submit" />
            </form>
        </div>
    </div>
</x-app-layout>
