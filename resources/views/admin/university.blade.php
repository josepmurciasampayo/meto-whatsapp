<x-app-layout>
    <h3>Edit University</h3>
    <form class="w-50" method="POST" action="{{ route('uni.update') }}">
        <input type="hidden" name="uni_id" value="{{ $uni->id }}">
        <input type="hidden" name="userToDelete" id="userToDelete" value="0">
        <input type="hidden" name="action" id="action" value="0">
        @csrf
        <x-inputs.text saved="{{ $uni->name }}" label="University Name" name="uniName"></x-inputs.text>
        <x-inputs.select saved="{{ $uni->type }}" label="Type" name="type" :options="\App\Enums\Institution\Type::descriptions()"></x-inputs.select>
        <x-inputs.text saved="{{ $uni->efc }}" label="Minimum EFC" name="efc"></x-inputs.text>
        <x-inputs.text saved="{{ $uni->connections }}" label="Connection Count" name="connections"></x-inputs.text>

        <hr class="my-5">

        @foreach ($users as $user)
            <div class="border p-3">
                <x-inputs.text saved="{{ $user->first }}" label="First Name" name="user[{{ $user->id }}][first]"></x-inputs.text>
                <x-inputs.text saved="{{ $user->last }}" label="Last Name" name="user[{{ $user->id }}][last]"></x-inputs.text>
                <x-inputs.text saved="{{ $user->email }}" label="Email Address" name="user[{{ $user->id }}][email]"></x-inputs.text>
                <x-inputs.text saved="{{ $user->title }}" label="Title" name="user[{{ $user->id }}][title]"></x-inputs.text>
                <div class="text-end">
                    <x-button type="button" onclick="deleteUser({{ $user->id }})">Delete</x-button>
                </div>
            </div>
        @endforeach


        <div class="text-end">
            <x-button type="button" onclick="addUser()">Add User</x-button>
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
        <div class="text-end">
            <x-button>Submit</x-button>
        </div>
    </form>
</x-app-layout>
