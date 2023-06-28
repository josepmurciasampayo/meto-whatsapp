<x-app-layout>
    @section('title', config('app.name') . ' - Getting Started')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mt-2">
        <x-image-with-text
            image-src="/img/Meto-background.webp"
            alt=""
            text="Student | Get Started"/>

        <div class="w-75 lg:max-w-md mt-6 px-6 py-4 bg-dark-subtle overflow-hidden sm:rounded-lg">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="w-full lg:w-3/4 xl:max-w-md mt-6 px-6 py-4 bg-success bg-opacity-25 overflow-hidden sm:rounded-lg">
                <form method="POST" action="{{ route('user.register') }}">
                    <input type="hidden" name="page" value="{{ \App\Enums\Page::GETSTARTED() }}">
                    @csrf

                    <div class="my-4 border border-secondary bg-light rounded-md p-2">
                        <x-inputs.text saved="{{ old('first') }}" name="first" label="First/Given Name"  req="true"></x-inputs.text>
                    </div>
                    <div class="my-4 border border-secondary bg-light rounded-md p-2">
                        <x-inputs.text saved="{{ old('middle') }}" name="middle" label="Middle Name" ></x-inputs.text>
                    </div>
                    <div class="my-4 border border-secondary bg-light rounded-md p-2">
                        <x-inputs.text saved="{{ old('last') }}" name="last" label="Last/Family Name"  req="true"></x-inputs.text>
                    </div>
                    <div class="my-4 border border-secondary bg-light rounded-md p-2">
                        <x-inputs.phone old="{{ (old('phone.code') || old('phone.number')) ? old('phone.code') . ',' . old('phone.number') : null }}" name="phone" label="Phone Number"  req="true"></x-inputs.phone>
                    </div>
                    <div class="my-4 border border-secondary bg-light rounded-md p-2">
                        <x-inputs.select saved="{{ old('owner') }}" name="owner" label="Who does this number belong to?" :options="$owners"></x-inputs.select>

                        @php $w = [1 => "I use this number for WhatsApp"] @endphp
                        <x-inputs.checkbox name="whatsapp" label="" :options="$w" class="whatsapp-checkbox"></x-inputs.checkbox>

                        @php $c = [1 => "I give consent to be contacted on WhatsApp"] @endphp
                        <x-inputs.checkbox name="consent" label="" :options="$c" class="consent-checkbox"></x-inputs.checkbox>
                    </div>
                    <div class="my-4 border border-secondary bg-light rounded-md p-2">
                        <x-inputs.text saved="{{ old('email') }}" name="email" label="Email Address"  req="true"></x-inputs.text>
                        <br/>
                        <x-inputs.text saved="{{ old('email_confirmation') }}" name="email_confirmation" label="Confirm Email"  req="true"></x-inputs.text>
                    </div>
                    <div class="my-4 border border-secondary bg-light rounded-md p-2">
                        <x-inputs.text-masked saved="{{ old('password') }}" name="password" type="password" label="Password"  req="true"></x-inputs.text-masked>
                        <br/>
                        <x-inputs.text-masked saved="{{ old('password_confirmation') }}" name="password_confirmation" type="password" label="Confirm Password" required req="true"></x-inputs.text-masked>
                    </div>

                    <div class="my-4 border border-secondary bg-light rounded-md p-2 checkboxes-consent">
                        @php
                        $link = "<span style='text-decoration: underline'><a target='_blank' href='" . route('terms') . " '>terms of use</a></span>";
                         $w = [1 => "I agree to the " . $link];
                        @endphp
                        <x-inputs.checkbox name="terms" label="By clicking Next: *Wel" :options="$w" class="whatsapp-checkbox" ></x-inputs.checkbox>

                        @php
                            $link = "<span style='text-decoration: underline'><a target='_blank' href='" . route('privacy') . " '>terms of use</a></span>";
                            $c = [1 => "I acknowledge the " . $link];
                        @endphp
                        <x-inputs.checkbox name="privacy" label="" :options="$c" class="consent-checkbox" ></x-inputs.checkbox>
                    </div>

                    <div class="text-center my-4">
                        <x-button-icon onclick="validateAndSubmit()" icon="fa fa-chevron-right" text="Next" />
                    </div>
                </form>
            </div>

            <div class="flex align-items-center justify-center mt-4 text-xs">
                <p>Already have a Meto account?</p>
                <span class="mx-2"></span>
                <x-button-nav href="{{route('login') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-10"><i class="fa fa-sign-in"></i> Log In</x-button-nav>
            </div>
        </div>
    </div>
</x-app-layout>
