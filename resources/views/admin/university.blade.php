<x-app-layout>
    @php $curricula = \App\Enums\Student\Curriculum::descriptions() @endphp
    <h3 class="display-7 mt-5 flex justify-center">Edit University Account</h3>
    <form id="uni" class="w-50" method="POST" action="{{ route('uni.update') }}">
        <input type="hidden" name="uni_id" value="{{ $uni->id }}">
        <input type="hidden" name="userToDelete" id="userToDelete" value="0">
        <input type="hidden" name="action" id="action" value="1">
        @csrf
        <x-inputs.text saved="{{ $uni->name }}" label="University Name" name="uniName"></x-inputs.text>
        <x-inputs.select saved="{{ $uni->type }}" label="Type" name="type" :options="\App\Enums\Institution\Type::descriptions()"></x-inputs.select>
        <x-inputs.text saved="{{ $uni->url }}" label="Homepage" name="url"></x-inputs.text>
        <x-inputs.text saved="{{ $uni->undergrad_url }}" label="Undergraduate Application" name="undergrad_url"></x-inputs.text>
        <x-inputs.country saved="{{ $uni->country }}" label="Country" name="country"></x-inputs.country>
        <x-inputs.text saved="{{ $uni->state }}" label="State/Province" name="state"></x-inputs.text>
        <x-inputs.text saved="{{ $uni->city }}" label="City" name="city"></x-inputs.text>

        <x-inputs.text saved="{{ $uni->efc }}" label="Minimum EFC" name="efc"></x-inputs.text>
        <x-inputs.select :options="$curricula" saved="{{ $uni->min_grade_curriculum }}" label="Minimum Grade Curriculum" name="min_grade_curriculum"></x-inputs.select>
        <x-inputs.text saved="{{ $uni->min_grade }}" label="Minimum Grade" name="min_grade"></x-inputs.text>
        <x-inputs.text saved="{{ $uni->min_grade_equivalency }}" label="Equivalency" name="min_grade_equivalency"></x-inputs.text>
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
                    <x-button type="button" onclick="deleteUser({{ $user->id }})">Delete User</x-button>
                </div>
            </div>
        @endforeach
        <div class="mt-3 text-end">
            <x-button type="button" onclick="document.getElementById('addUser').classList.remove('d-none')">Add User</x-button>
            <x-button>Submit University Updates</x-button>
        </div>
    </form>

    <form id="addUser" class="w-50 d-none" method="POST" action="{{ route('uni.update') }}">
        <input type="hidden" name="action" id="action" value="3">
        <input type="hidden" name="uni_id" value="{{ $uni->id }}">
        @csrf
        <x-inputs.text label="First Name" name="first"></x-inputs.text>
        <x-inputs.text label="Last Name" name="last"></x-inputs.text>
        <x-inputs.text label="Email Address" name="email"></x-inputs.text>
        <x-inputs.text label="Title" name="title"></x-inputs.text>
        <div class="text-end">
            <x-button>Submit New User</x-button>
        </div>
    </form>

    <script type="text/javascript">
        function deleteUser(id) {
            document.getElementById('action').value = 4;
            document.getElementById('userToDelete').value = id;
            document.forms[0].submit();
        }
    </script>
</x-app-layout>
