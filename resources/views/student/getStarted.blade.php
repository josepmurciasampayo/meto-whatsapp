<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
               <x-image-with-text
                                  image-src="/img/Meto-background.webp"
                                  alt=""
                                  text="Student | Get Started"/>

        <div class="w-75 lg:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('user.register') }}">
                <input type="hidden" name="page" value="{{ \App\Enums\Page::GETSTARTED() }}">
                @csrf
                <x-inputs.text name="first" label="First/Given Name" required req="{{ \App\Enums\General\YesNo::YES }}"></x-inputs.text>
                <x-inputs.text name="middle" label="Middle Name" ></x-inputs.text>
                <x-inputs.text name="last" label="Last/Family Name" required req="{{ \App\Enums\General\YesNo::YES }}"></x-inputs.text>
                <x-inputs.phone name="phone" label="Phone Number" required req="{{ \App\Enums\General\YesNo::YES }}" />
                <x-inputs.select name="owner" lbael="Who does this number belong to?" :options="" />
                <x-inputs.text name="email" label="Email Address" required req="{{ \App\Enums\General\YesNo::YES }}"></x-inputs.text>
                <x-inputs.text name="emailConfirm" label="Confirm Email" required req="{{ \App\Enums\General\YesNo::YES }}"></x-inputs.text>
                <x-inputs.text name="password" type="password" label="Password" required req="{{ \App\Enums\General\YesNo::YES }}"></x-inputs.text>
                <x-inputs.text name="passwordConfirm" type="password" label="Confirm Password" required req="{{ \App\Enums\General\YesNo::YES }}"></x-inputs.text>

                <div class="text-center my-4">
                    <x-button-icon onclick="validateAndSubmit()" icon="fa fa-chevron-right" text="Next" />
                  </div>
            </form>

            <div class="flex align-items-center justify-center mt-20 text-xs">
                <p>Already have a Meto account?</p>
                <span class="mx-2"></span>
                <x-button-nav href="{{route('login') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-10"><i class="fa fa-sign-in"></i> Log In</x-button-nav>
            </div>
        </div>
    </div>
</x-app-layout>


