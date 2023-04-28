<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mt-2">
        <x-image-with-text
                           image-src="/img/Meto-background.webp"
                           alt=""
                           text="Basic Information"/>

 <div class="w-75 lg:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
     @php
     $owners = [
         'It is mine' => 'It is mine',
         'My Mother' => 'My Mother',
         'My Father' => 'My Father',
         'Another relative' => 'Another relative',
         'A teacher' => 'A teacher',
         'Other' => 'Other',
     ];
     @endphp

     <form method="POST" action="{{ route('user.register') }}">
         <input type="hidden" name="page" value="{{ \App\Enums\Page::GETSTARTED() }}">
         @csrf
         <x-inputs.text name="first" label="First/Given Name" saved="{{ $user->first }}"></x-inputs.text>
         <x-inputs.text name="middle" label="Middle Name" saved="{{ $user->middle }}"></x-inputs.text>
         <x-inputs.text name="last" label="Last/Family Name" saved="{{ $user->last }}"></x-inputs.text>
         <x-inputs.email name="email" label="Email" saved="{{ $user->email }}"></x-inputs.email>
        <x-inputs.phone name="phone" label="Phone Number" required req="{{ \App\Enums\General\YesNo::YES }}"></x-inputs.phone>
         <x-inputs.select name="owner" label="Who does this number belong to?" :options="$owners"></x-inputs.select>
         @php $w = [1 => "I use this number for WhatsApp"] @endphp
         <div class="form-group checkbox-container">
             <x-inputs.checkbox name="whatsapp" label="" :options="$w" class="whatsapp-checkbox"></x-inputs.checkbox>
             <label for="whatsapp" class="whatsapp-label checkbox-label"></label>
         </div>
         @php $c = [1 => "I give consent to be contacted on WhatsApp"] @endphp
         <div class="form-group checkbox-container">
             <x-inputs.checkbox name="consent" label="" :options="$c" class="consent-checkbox"></x-inputs.checkbox>
             <label for="consent" class="consent-label checkbox-label"></label>
         </div>
         <x-inputs.country name="country" label="Country"></x-inputs.country>

         <div class="text-center my-4">
             <x-button-icon onclick="validateAndSubmit()" icon="fas fa-save" text="Save" />
           </div>

                 <div class="mt-6 flex items-center justify-center">
                     <x-icon-link href="{{ route('password.request') }}" icon="fa fa-sync-alt" text="Reset Password"/>
                 </div>

             </form>
        </div>
    </div>
</x-app-layout>

