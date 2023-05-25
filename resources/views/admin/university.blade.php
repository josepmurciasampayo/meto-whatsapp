<x-app-layout>
    <h3 class="display-7 mt-5 flex justify-center">Edit University Account</h3>
    <form class="w-50" method="POST" action="{{ route('uni.update') }}">
        <input type="hidden" name="uni_id" value="{{ $uni->id }}">
        <input type="hidden" name="userToDelete" id="userToDelete" value="0">
        <input type="hidden" name="action" id="action" value="0">
        @csrf
        <x-inputs.text saved="{{ $uni->name }}" label="University Name" name="uniName"></x-inputs.text>
        <x-inputs.select saved="{{ $uni->type }}" label="Type" name="type" :options="\App\Enums\Institution\Type::descriptions()"></x-inputs.select>
        <x-inputs.text saved="{{ $uni->url }}" label="Homepage" name="url"></x-inputs.text>
        <x-inputs.text saved="{{ $uni->undergrad_url }}" label="Undergraduate Application" name="undergrad_url"></x-inputs.text>
        <x-inputs.country saved="{{ $uni->country }}" label="Country" name="country"></x-inputs.country>
        <x-inputs.text saved="{{ $uni->state }}" label="State/Province" name="state"></x-inputs.text>
        <x-inputs.text saved="{{ $uni->city }}" label="City" name="city"></x-inputs.text>

        <x-inputs.text saved="{{ $uni->efc }}" label="Minimum EFC" name="efc"></x-inputs.text>
        <x-inputs.text saved="{{ $uni->connections }}" label="Connection Count" name="connections"></x-inputs.text>

        <hr class="my-5">

        @foreach ($users as $user)
            <div class="border p-3">
                <x-inputs.text saved="{{ $user->first }}" label="First Name" name="user[{{ $user->id }}][first]"></x-inputs.text>
                <x-inputs.text saved="{{ $user->last }}" label="Last Name" name="user[{{ $user->id }}][last]"></x-inputs.text>
                @php $email = (strlen($user->email) > 4) ? $user->email : "" @endphp
                <x-inputs.text saved="{{ $email }}" label="Email Address" name="user[{{ $user->id }}][email]"></x-inputs.text>
                <x-inputs.text saved="{{ $user->title }}" label="Title" name="user[{{ $user->id }}][title]"></x-inputs.text>
                <div class="text-end">
                    <x-button type="button" onclick="deleteUser({{ $user->id }})">Delete</x-button>
                </div>
            </div>
        @endforeach

        <div class="mt-3 text-end">
            <x-button type="button" onclick="addUser()">Add User</x-button>

                <x-button>Submit</x-button>

        </div>

        <script type="text/javascript">
            function addUser() {
                document.getElementById('action').value = 3;
                document.forms[0].submit();
            }

            function deleteUser(id) {
                document.getElementById('action').value = 4;
                document.getElementById('userToDelete').value = id;
                document.forms[0].submit();
            }
        </script>

    </form>
</x-app-layout>
