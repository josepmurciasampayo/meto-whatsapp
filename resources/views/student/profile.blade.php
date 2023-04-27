<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 mt-5">
        <x-image-with-text
                           image-src="/img/Meto-background.webp"
                           alt=""
                           text="Basic Information"/>
        <div class="w-75 lg:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('student.handle') }}">
                 <input-text type="hidden" name="page" value="{{ \App\Enums\Page::GETSTARTED() }}">
                 @csrf
                 <x-inputs.text name="first" label="First/Given Name" saved="{{ $user->first }}"></x-inputs.text>
                 <x-inputs.text name="middle" label="Middle Name" saved="{{ $user->middle }}"></x-inputs.text>
                 <x-inputs.text name="last" label="Last/Family Name" saved="{{ $user->last }}"></x-inputs.text>
                 <x-inputs.email name="email" label="Email" saved="{{ $user->email }}"></x-inputs.email>
                 <x-inputs.country name="country" label="Country"></x-inputs.country>
                 <x-inputs.phone name="whatsapp" label="WhatsApp" saved="{{ $user->whatsapp }}"></x-inputs.phone>
                 <x-button-icon type="submit" icon="fa fa-save" text="Save" />

                 <div class="mt-6 flex items-center justify-center">
                     <x-icon-link href="{{ route('password.request') }}" icon="fa fa-sync-alt" text="Reset Password"/>
                 </div>

             </form>
        </div>
    </div>
</x-app-layout>
