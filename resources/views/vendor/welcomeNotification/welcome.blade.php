<x-app-layout>
    <div class="min-h-screen">
    <p class="my-3 display-7">Welcome to Meto! Create a password below and you will be automatically logged in.</p>
    <form class="mt-5 w-50" method="POST">
        @csrf
        <input type="hidden" name="email" value="{{ $user->email }}"/>
        <div>
            <label for="password">{{ __('Password') }}</label>
            <div>
                <x-input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password"></x-input>
                @error('password')
                <span>
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div>
            <label for="password-confirm">{{ __('Confirm Password') }}</label>

            <div>
                <x-input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password"></x-input>
            </div>
        </div>

        <div class="text-end">
            <x-button type="submit">
                {{ __('Save password and login') }}
            </x-button>
        </div>
    </form>
</x-app-layout>
