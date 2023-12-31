<x-app-layout>
    <div class="justify-center min-h-screen mt-2 mx-2 w-full">
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 display-7">
                   <?php echo $user->first . ' ' . $user->last ?>
                </div>
                <div class="p-6">
                    <form  method="POST" action="{{ route('profile.update') }}" name="profile" id="profile">
                        @csrf

                        <input type="hidden" name="id" id="id" value="{{ $user->id }}">

                        <div class="mb-4">
                            <x-label for="first" value="First" />
                            <x-input saved="{{ $user->first }}" id="first" class="block mt-1 w-full" type="text" name="first" autofocus />
                        </div>

                        <div class="mb-4">
                            <x-label for="last" value="Last" />
                            <x-input id="last" class="block mt-1 w-full" type="text" name="last" saved="{{ $user->last }}" />
                        </div>

                        <div class="mb-4">
                            <x-label for="email" value="Email" />
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" saved="{{ $user->email }}" />
                        </div>

                        <div class="mb-4">
                            <x-label for="phone" value="Phone" />
                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" saved="{{ $user->phone_raw }}" />
                        </div>

                        <div class="mb-4">
                            <x-label for="title" value="Title" />
                            <x-input id="title" class="block mt-1 w-full" type="text" name="title" saved="{{ $user->title }}" />
                        </div>

                        <div class="mb-4">
                            <x-label for="linkedin_url" value="LinkedIn Profile URL" />
                            <x-input id="linkedin_url" class="block mt-1 w-full" type="text" name="linkedin_url" saved="{{ $user->linkedin_url }}" />
                        </div>

                        <?php if (Auth()->user()->isCounselor()) { ?>
                            <div class="mb-4">
                                <x-label for="subscribe" value="Subscribe to student connections email notifications" />
                                <div class="btn-group" role="group" aria-label="Email subscription">
                                    <?php $on_checked = ($join->sub_email == 1) ? "checked" : ""; ?>
                                    <?php $off_checked = ($join->sub_email == 0) ? "checked" : ""; ?>
                                    <input type="radio" class="btn-check" name="subscribe" id="subscribe_on" autocomplete="off" {{ $on_checked }}>
                                    <label class="btn btn-outline-success" for="subscribe_on">I want email notifications</label>

                                    <input type="radio" class="btn-check" name="subscribe" id="subscribe_off" autocomplete="off" {{ $off_checked }}>
                                    <label class="btn btn-outline-success" for="subscribe_off">I do not want emails</label>
                                </div>
                            </div>
                        <?php } ?>

                        <div class="text-end">
                            <div class="mb-6">
                                <x-button>Submit Changes</x-button>
                            </div>
                                <a href="{{ route('password.reset') }}">
                                    <x-button-secondary type="button">Change Password</x-button-secondary>
                                </a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
