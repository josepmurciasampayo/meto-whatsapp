<x-app-layout>
    <?php $title = ($isInvite) ? "Counselor Invitation" : "Counselor Profile" ?>
    <div class="p-6 bg-white border-b border-gray-200">{{ $title }}</div>
    <?php if ($isInvite) { ?>
    <h3>Please share the information for the person you would like to invite. This person will have access to the same information that you do. Note: You may not invite anyone who does not work for the institution</h3>
    <?php } ?>
    <div class="p-6">
        <form id="invite" name="invite" action="{{ route('sendInvite') }}" method="POST">
            @csrf

            <input type="hidden" name="highschool_id" id="highschool_id" value="{{ $highschool_id }}">
            <input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}">

            <div class="mb-4">
                <?php $first = $user->first ?? '' ?>
                <x-label for="first" value="First Name" />
                <x-input class="block mt-1 w-full" id="first" name="first" type="text" value="{{ $first }}" autofocus />
            </div>

            <div class="mb-4">
                <?php $last = $user->last ?? '' ?>
                <x-label for="last" value="Last Name" />
                <x-input class="block mt-1 w-full" id="last" name="last" type="text" value="{{ $last }}" />
            </div>

            <div class="mb-4">
                <?php $email = $user->email ?? '' ?>
                <x-label for="email" value="Email Address" />
                <x-input class="block mt-1 w-full" id="email" name="email" type="text" value="{{ $email }}" />
            </div>

            <div class="mb-4">
                <?php $title = $user->title ?? '' ?>
                <x-label for="title" value="Title" />
                <x-input class="block mt-1 w-full" id="title" name="title" type="text" value="{{ $title }}"/>
            </div>

            <div class="mb-4">
                <x-label for="role" value="Account Type" />
                <select class="form-control" id="role" name="role">
                    <?php $isCounselor = ($role == \App\Enums\HighSchool\Role::COUNSELOR()) ? "selected" : ""; ?>
                    <?php $isAdmin = ($role == \App\Enums\HighSchool\Role::ADMIN()) ? "selected" : ""; ?>
                    <option value="{{ \App\Enums\HighSchool\Role::COUNSELOR() }}" {{ $isCounselor }}>Regular</option>
                    <option value="{{ \App\Enums\HighSchool\Role::ADMIN() }}" {{ $isAdmin }}>Admin</option>
                </select>
            </div>

            <div class="text-end p-3">
                <?php $button = ($isInvite) ? "Invite" : "Update" ?>
                <x-button>{{ $button }}</x-button>
            </div>
        </form>
    </div>
</x-app-layout>
