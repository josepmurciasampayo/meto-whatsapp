<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <x-image-with-text
                           image-src="/img/Meto-background.webp"
                           alt=""
                           text="Profile"/>
        <div class="w-75 lg:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('student.handle') }}">
                 <input type="hidden" name="page" value="{{ \App\Enums\Page::GETSTARTED() }}">
                 @csrf
                 <x-input name="first" label="First/Given Name" saved="{{ $user->first }}"></x-input>
                 <x-input name="middle" label="Middle Name" saved="{{ $user->middle }}"></x-input>
                 <x-input name="last" label="Last/Family Name" saved="{{ $user->last }}"></x-input>
                 <x-input name="country" label="Country"></x-input>
                 <x-input name="whatsapp" label="WhatsApp" saved="{{ $user->whatsapp }}"></x-input>
                 <x-button-icon type="submit" icon="fa fa-save" text="Save" />

                 <div class="mt-6 flex items-center justify-center">
                     <x-icon-link href="{{ route('password.request') }}" icon="fa fa-sync-alt" text="Reset Password"/>
                 </div>

             </form>
        </div>
    </div>
</x-app-layout>
