<x-app-layout>
    <div class="min-h-screen items-center">
        <div class="text-center mt-6 text-xl">
            <h3 class="mb-4 mt-6">Hello!</h3>
            <h4 class="mb-4 mt-6 display-7">Welcome to {{ config('app.name') }}, the online meeting place where you can efficiently connect with students.</h4>
            <p class="mb-4 mt-6 text-xl">We will now ask you a short series of questions. Your answers will help us ensure that your review
            and connection process is as efficient as possible. It will take around 3 minutes.
            </p>
            <x-button onclick="window.location.assign('/uni-name')">Let's Go <i class="fas fa-arrow-right"></i></x-button>
        </div>
    </div>
</x-app-layout>

