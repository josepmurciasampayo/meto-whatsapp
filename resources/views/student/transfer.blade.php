<x-app-layout>

    <x-image-with-text
    image-src="/img/Meto-background.webp"
    alt=""
    text="Transfer Students"/>
      

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-75 lg:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('student.handle') }}">
                @csrf
                <x-input name="first" label="First/Given Name"></x-input>
                <x-input name="middle" label="Middle Name"></x-input>
                <x-input name="last" label="Last/Family Name"></x-input>
                <x-input name="country" label="Country"></x-input>
                <x-input name="gender" label="Gender"></x-input>
                <x-input name="email" label="Email Address"></x-input>
                <x-input name="phone" label="Phone Number"></x-input>

                <x-button-icon type="submit" icon="fa fa-share-square" text="Submit" />
            </form>
        </div>
    </div>
</x-app-layout>



