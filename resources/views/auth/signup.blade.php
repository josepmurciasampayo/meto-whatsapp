<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h3>Sign Up to Get Started</h3>
            <a href="{{ route('signup.student') }}"><img src="/img/signup-student.svg"></a>
            <a href="{{ route('signup.counselor') }}"><img src="/img/signup-counselor.jpeg"></a>
            <a href="{{ route('signup.uni') }}"><img src="/img/signup-uni.svg"></a>
        </div>
    </div>
</x-app-layout>
