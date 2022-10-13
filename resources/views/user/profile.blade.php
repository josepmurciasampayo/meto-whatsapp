<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg" style="max-width: 70%">
                <div class="p-6 bg-white border-b border-gray-200">
                    Profile - <?php echo $user->first . ' ' . $user->last ?>
                </div>
                <div class="p-6">
                    <form  method="POST" action="{{ route('profile.update') }}" name="profile" id="profile">
                        @csrf

                        <input type="hidden" name="id" id="id" value="{{ $user->id }}">

                        <div class="mb-4">
                            <x-label for="first" value="First" />
                            <x-input id="first" class="block mt-1 w-full" type="text" name="first" :value="$user->first" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-label for="last" value="Last" />
                            <x-input id="last" class="block mt-1 w-full" type="text" name="last" :value="$user->last" />
                        </div>

                        <div class="mb-4">
                            <x-label for="email" value="Email" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$user->email" />
                        </div>

                        <div class="mb-4">
                            <x-label for="phone" value="Phone" />
                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="$user->phone_raw" />
                        </div>

                        <div class="mb-4">
                            <x-label for="title" value="Title" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" :value="$user->title" />
                        </div>

                        <?php if (Auth()->user()->isCounselor()) { ?>
                            <div class="mb-4">
                                <x-label for="subscribe" value="Subscribe to student connections" />
                                // TODO: create subscribe toggle
                            </div>
                        <?php } ?>

                        <div class="mb-4">
                            <a href="{{ route('password.reset') }}">Change Password</a>
                        </div>



                        <div class="text-end">
                            <x-button>Submit Changes</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
