<x-app-layout>

    <!-- TODO: To much space between the header - main - footer on mobile -->
    
    <div class="min-h-screen flex sm:flex-row sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:w-1/2 sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <x-label for="email">{{ __('Email') }} </x-label>
                    <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
                </div>
                <div class="mt-4">
                    <x-label for="password">{{ __('Password') }}</x-label>
                    <x-input id="password" class="block mt-1 w-full"
                             type="password"
                             name="password"
                             required autocomplete="current-password" />
                </div>
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <x-button class="ml-3"><i class="fa fa-sign-in" aria-hidden="true"></i>
                        {{ __('Log in') }}
                    </x-button>
                </div>
                <div class="flex align-items-center justify-center mt-6 text-xs">
                    <p>Don't have a Meto account?</p>
                    <span class="mx-2"></span>
                    <x-button-nav href="{{route('signup') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-50"><i class="fas fa-user-plus"></i> Create an Account</x-button-nav>

                </div>
            </form>
        </div>
        <div class="hidden sm:block sm:w-1/2" style="width: 440px; height: auto; margin-left: 5rem;">
            <img src="/img/Meto-background.webp" alt="">
        </div>
    </div>
</x-app-layout>


