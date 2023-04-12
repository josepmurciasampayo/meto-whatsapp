<x-app-layout>
<h3>Basic Information</h3>
    <form method="POST" action="">
        @csrf
        <x-input-text name="first" label="First" />
        <x-input-text name="last" label="Last" />
        <x-input-text name="email" label="Email" />
        <x-input-text name="title" label="Job Title" />
        <x-input-text name="linkedin" label="LinkedIn URL" />
        <x-input-text name="whatsapp" label="WhatsApp Number" />
        <x-button name="submit">Update</x-button>
    </form>
    <a href="">Reset Password</a>
</x-app-layout>
