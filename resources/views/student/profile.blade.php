<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0">
        <x-image-with-text
                           image-src="/img/Meto-background.webp"
                           alt=""
                           text="Profile"/>
        <div class="w-75 lg:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('student.handle') }}">
                 <input-text type="hidden" name="page" value="{{ \App\Enums\Page::GETSTARTED() }}">
                 @csrf
                 <x-input-text name="first" label="First/Given Name" saved="{{ $user->first }}"></x-input-text>
                 <x-input-text name="middle" label="Middle Name" saved="{{ $user->middle }}"></x-input-text>
                 <x-input-text name="last" label="Last/Family Name" saved="{{ $user->last }}"></x-input-text>
                 <x-inputs.country name="country" label="Country"></x-inputs.country>
                 <x-input-text name="whatsapp" label="WhatsApp" saved="{{ $user->whatsapp }}"></x-input-text>
                 <x-button-icon type="submit" icon="fa fa-save" text="Save" />

                 <div class="mt-6 flex items-center justify-center">
                     <x-icon-link href="{{ route('password.request') }}" icon="fa fa-sync-alt" text="Reset Password"/>
                 </div>

             </form>
        </div>
    </div>
</x-app-layout>
