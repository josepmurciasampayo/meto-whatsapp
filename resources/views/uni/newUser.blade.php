<x-app-layout>
<h3>Add New User</h3>
    <form method="POST" action="">
        @csrf
        <x-input-text name="first" label="First" />
        <x-input-text name="last" label="Last" />
        <x-input-text name="email" label="Email" />
        <x-input-text name="title" label="Job Title" />


        <x-button>Send Invite</x-button>
    </form>
</x-app-layout>
