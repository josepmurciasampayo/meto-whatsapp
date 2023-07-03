<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mt-2">
        <x-image-with-text image-src="/img/Meto-background.webp" alt="" text="University and Scholarship Recruiters | Get Started"/>
        <div class="w-50 lg:w-3/4 xl:max-w-md mt-6 px-6 py-4 bg-success bg-opacity-25 overflow-hidden sm:rounded-lg">
            <p class="text-xm text-center my-3 font-semibold">Please complete the form below. Your response will be submitted to Meto for review, and then you will be granted access to Meto's database.</p>

            <form method="POST" action="{{ route('signup.uni.store') }}">
                @csrf
                <div class="my-4 border border-secondary bg-light rounded-md p-2">
                    <x-inputs.text label="Name" name="name" help="Please enter your full name. This information will assist us in reviewing your request." req="true"></x-inputs.text>
                </div>

                <div class="my-4 border border-secondary bg-light rounded-md p-2">
                    <x-inputs.text label="Institution Name" name="institution" req="true"></x-inputs.text>
                </div>

                <div class="my-4 border border-secondary bg-light rounded-md p-2">
                    <x-inputs.text label="Email Address" name="email" req="true"></x-inputs.text>
                </div>

                <div class="my-4 border border-secondary bg-light rounded-md p-2">
                    <x-inputs.text label="Job Title" name="title" req="true"></x-inputs.text>
                </div>

                <div class="my-4 border border-secondary bg-light rounded-md p-2">
                    <x-inputs.textarea label="How did you hear about Meto and how are you looking to use Meto?" name="how"></x-inputs.textarea>
                </div>

                <div class="text-center my-4">
                    <x-button-icon type="submit" icon="" text="Request Invite" />
                </div>
            </form>

            <p class="text-xm text-center mt-5 font-semibold">Please note that you will be able to add coworkers to your institution account once your request is approved.</p>
        </div>
        <div class="flex align-items-center justify-center mt-3 text-xm">
            <p>Already have a Meto account?</p>
            <span class="mx-2"></span>
            <x-button-nav href="{{route('login') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-10"><i class="fa fa-sign-in"></i> Log In</x-button-nav>
        </div>
    </div>
</x-app-layout>
