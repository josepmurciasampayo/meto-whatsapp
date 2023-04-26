<x-app-layout>
<h3>Add New User</h3>
    <form method="POST" action="">
        @csrf
        <x-inputs.text name="first" label="First" />
        <x-inputs.text name="last" label="Last" />
        <x-inputs.text name="email" label="Email" />
        <x-inputs.text name="title" label="Job Title" />


        <x-button>Send Invite</x-button>
    </form>
</x-app-layout>
