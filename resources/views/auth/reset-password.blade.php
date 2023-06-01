<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 mx-4">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                @if ($user)
                    <input type="hidden" name="email" value="{{ $user->email }}">
                @else
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div>
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                    </div>
                @endif

                <div class="mt-4">
                    <x-input label="Password" class="block mt-1 w-full" type="password" name="password" required />
                </div>

                <div class="mt-4">
                    <x-input label="Confirm Password" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button>Reset Password</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
