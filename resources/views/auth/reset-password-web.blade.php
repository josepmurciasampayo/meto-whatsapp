<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 mx-4">
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            @if (session('error'))
                <p>{{ session('error') }}</p>
            @endif
            <form method="POST" action="{{ action([\App\Http\Controllers\Auth\updatePassword::class]) }}">
                @csrf

                <div class="mt-4">
                    <x-label for="new_password" value="New Password" />
                    <x-input id="new_password" class="block mt-1 w-full" type="password" name="new_password" required />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-input id="password_confirmation" class="block mt-1 w-full"
                             type="password"
                             name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <script type="text/javascript">
                        function verify() {
                            if (document.getElementById('new_password').value !== document.getElementById('password_confirmation')) {
                                alert('Passwords do not match');
                            } else {
                                document.forms[0].submit();
                            }
                        }
                    </script>
                    <x-button type="button" onclick="verify()">Reset Password</x-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
