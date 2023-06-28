<x-app-layout>
    @section('title', config('app.name') . ' - Student Profile')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 mt-2">
        <x-image-with-text image-src="/img/Meto-background.webp" alt="" text="Basic Information"/>

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
             <form method="POST" action="{{ route('user.update') }}">
                 <input type="hidden" name="page" value="{{ \App\Enums\Page::GETSTARTED() }}">
                 @csrf
                 <div class="my-4 border border-secondary bg-light rounded-md p-2">
                     <x-inputs.text name="first" label="First/Given Name" saved="{{ $user->first }}"></x-inputs.text>
                 </div>

                 <div class="my-4 border border-secondary bg-light rounded-md p-2">
                     <x-inputs.text name="middle" label="Middle Name" saved="{{ $user->middle }}"></x-inputs.text>
                 </div>

                 <div class="my-4 border border-secondary bg-light rounded-md p-2">
                     <x-inputs.text name="last" label="Last/Family Name" saved="{{ $user->last }}"></x-inputs.text>
                 </div>

                 <div class="my-4 border border-secondary bg-light rounded-md p-2">
                     <x-inputs.email name="email" label="Email" saved="{{ $user->email }}"></x-inputs.email>
                 </div>

                 <div class="my-4 border border-secondary bg-light rounded-md p-2">
                     <x-inputs.phone name="phone" json="{{ $user->phone_array }}" label="Phone Number" req="true"></x-inputs.phone>
                 </div>

                 <div class="my-4 border border-secondary bg-light rounded-md p-2">
                 <x-inputs.select name="owner" saved="{{ $user->phone_owner ?? '' }}" label="Who does this number belong to?" :options="$owners"></x-inputs.select>
                     @php $w = [1 => "I use this number for WhatsApp"] @endphp
                     <x-inputs.checkbox name="whatsapp" label="" :options="$w" class="whatsapp-checkbox"></x-inputs.checkbox>

                     @php $c = [1 => "I give consent to be contacted on WhatsApp"] @endphp
                     <x-inputs.checkbox name="consent" label="" :options="$c" class="consent-checkbox"></x-inputs.checkbox>
                 </div>

                 <div class="text-center my-4">
                     <x-button-icon onclick="validateAndSubmit()" icon="fas fa-save" text="Save" />
                 </div>

                 <div class="mt-6 flex items-center justify-center">
                     <x-icon-link href="{{ route('password.reset') }}" icon="fa fa-sync-alt" text="Reset Password"/>
                 </div>

             </form>
        </div>
    </div>
</x-app-layout>

