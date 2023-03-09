<x-app-layout>
    <h3>University and Scholarship Recruiters | Get Started</h3>
    <form method="POST" action="{{ route('signup.uni.store') }}">
        @csrf
        <x-input label="First Name" name="first"></x-input>
        <x-input label="Last Name" name="last"></x-input>
        <x-input label="Email Address" name="email"></x-input>
        <x-input label="Password" name="password"></x-input>
        <x-input label="Job Title" name="title"></x-input>
        <x-input label="Institution Name" name="institution"></x-input>
        <x-button type="submit">Sign Up</x-button>
    </form>
    <div class="text-center">
    <p>Already have an account? <a href="">Log In</a></p>
    <p>Please note that you will be able to add coworkers to your institution account once your request is approved.</p>
    </div>
</x-app-layout>
