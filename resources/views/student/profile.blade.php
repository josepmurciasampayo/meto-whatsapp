<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mt-2">
        <x-image-with-text
                           image-src="/img/Meto-background.webp"
                           alt=""
                           text="Basic Information"/>

     <div class="w-75 w-100-sm lg:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
         <form method="POST" action="{{ route('user.update') }}">
             <input type="hidden" name="page" value="{{ \App\Enums\Page::GETSTARTED() }}">
             @csrf
             <x-inputs.text disabled name="first" label="First/Given Name" saved="{{ $user->first }}"></x-inputs.text>
             <x-inputs.text disabled name="middle" label="Middle Name" saved="{{ $user->middle }}"></x-inputs.text>
             <x-inputs.text disabled name="last" label="Last/Family Name" saved="{{ $user->last }}"></x-inputs.text>
             <x-inputs.email disabled name="email" label="Email" saved="{{ $user->email }}"></x-inputs.email>
             <x-inputs.phone name="phone" saved="{!! $user->phone_array !!}" label="Phone Number" req="true"></x-inputs.phone>
             <x-inputs.select name="owner" saved="{{ $user->phone_owner ?? '' }}" label="Who does this number belong to?" :options="$owners"></x-inputs.select>
             @php $w = [1 => "I use this number for WhatsApp"] @endphp
             <div class="form-group checkbox-container">
                 @php $answer = (is_null($user->whatsapp_used)) ? [] : explode(',', $user->whatsapp_used) @endphp
                 <x-inputs.checkbox name="whatsapp" label="" :saved="$answer" :options="$w" class="whatsapp-checkbox"></x-inputs.checkbox>
                 <label for="whatsapp" class="whatsapp-label checkbox-label"></label>
             </div>
             <div class="form-group checkbox-container">
                @php $c = [1 => "I give consent to be contacted on WhatsApp"] @endphp
                 @php $answer = ($user->whatsapp_consent == \App\Enums\User\Consent::CONSENT()) ? [1] : [] @endphp
                 <x-inputs.checkbox name="consent" label="" :saved="$answer" :options="$c" class="consent-checkbox"></x-inputs.checkbox>
                 <label for="consent" class="consent-label checkbox-label"></label>
             </div>

             <div class="text-center my-4">
                 <x-button-icon onclick="validateAndSubmit()" icon="fas fa-save" text="Save" />
             </div>

             <div class="mt-6 flex items-center justify-center">
                 <x-icon-link href="{{ action([\App\Http\Controllers\Auth\getPasswordResetView::class]) }}" icon="fa fa-sync-alt" text="Reset Password"/>
             </div>

             </form>
        </div>
    </div>
</x-app-layout>

