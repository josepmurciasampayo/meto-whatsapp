<x-app-layout>
<h3>Basic Information</h3>
    <form method="POST" action="">
        @csrf
        <x-inputs.text name="first" label="First" />
        <x-inputs.text name="last" label="Last" />
        <x-inputs.text name="email" label="Email" />
        <x-inputs.text name="title" label="Job Title" />
        <x-inputs.text name="linkedin" label="LinkedIn URL" />
        <x-inputs.text name="whatsapp" label="WhatsApp Number" />
        <x-button name="submit">Update</x-button>
    </form>
    <a href="{{ __('Reset Password') }}">Reset Password</a>
</x-app-layout>
