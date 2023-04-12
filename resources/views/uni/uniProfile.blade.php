<x-app-layout>
<h3>Hello, </h3>
    <h4>Account Preferences</h4>
    <form method="POST" action="">
        @csrf
        <x-input-text name="instName" label="Institution Name" />
        <x-input-text name="website" label="Website URL" />
        <x-input-text name="country" label="Country" />
        <x-input-text name="rank" label="University Rank Information" />
        <x-input-text name="appURL" label="Application Link" />
        <x-input-text name="earlyDeadline" label="Early Decision/Action Deadline" />
        <x-input-text name="regularDeadline" label="Regular Decision/Action Deadline" />
        <x-button>Update</x-button>
    </form>
</x-app-layout>
