<x-app-layout>
<h3>Hello, </h3>
    <h4>Account Preferences</h4>
    <form method="POST" action="">
        @csrf
        <x-inputs.text name="instName" label="Institution Name" />
        <x-inputs.text name="website" label="Website URL" />
        <x-inputs.text name="country" label="Country" />
        <x-inputs.text name="rank" label="University Rank Information" />
        <x-inputs.text name="appURL" label="Application Link" />
        <x-inputs.text name="earlyDeadline" label="Early Decision/Action Deadline" />
        <x-inputs.text name="regularDeadline" label="Regular Decision/Action Deadline" />
        <x-button>Update</x-button>
    </form>
</x-app-layout>
