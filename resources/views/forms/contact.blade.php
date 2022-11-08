<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            <form method="POST" action="{{ route('contact.store') }}" id="contact">
                @csrf

                <?php if (is_null($user)) { ?>
                    <input type="hidden" name="user_id" id="user_id" value="0">

                    <div>
                        <x-label for="email" value="Name" />
                        <x-input type="text" name="name" id="name" />
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="Email" />
                        <x-input type="text" name="email" id="email" />
                    </div>

                    <div class="mt-4">
                        <x-label for="phone" value="Phone" />
                        <x-input type="tel" name="phone" id="phone" />
                    </div>
                <?php } else { ?>
                    <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                <?php } ?>

                <div class="mt-4">
                    <x-label for="text" value="Message" />
                    <textarea name="text" id="text" rows="3" class="form-control"></textarea>
                </div>

                <div class="mt-4">
                    <div class="flex items-center justify-end ">
                        <x-button>Submit</x-button>
                    </div>
                </div>

            </form>
        </div>
    </div>

</x-app-layout>
