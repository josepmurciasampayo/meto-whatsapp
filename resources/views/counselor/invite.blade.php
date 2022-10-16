<x-app-layout>
    <div class="p-6 bg-white border-b border-gray-200">
        Counselor Invitation
    </div>
    <div class="p-6">
        <form id="invite" name="invite" action="{{ route('sendInvite') }}" method="POST">
            @csrf

            <div class="mb-4">
                <x-label for="first" value="First Name" />
                <x-input class="block mt-1 w-full" id="first" name="first" type="text" autofocus />
            </div>

            <div class="mb-4">
                <x-label for="last" value="Last Name" />
                <x-input class="block mt-1 w-full" id="last" name="last" type="text" />
            </div>

            <div class="mb-4">
                <x-label for="email" value="Email Address" />
                <x-input class="block mt-1 w-full" id="email" name="email" type="text" />
            </div>

            <div class="mb-4">
                <x-label for="title" value="Title" />
                <x-input class="block mt-1 w-full" id="title" name="title" type="text" />
            </div>

            <div class="text-end p-3">
                <x-button>Send Invite</x-button>
            </div>
        </form>
    </div>
</x-app-layout>
