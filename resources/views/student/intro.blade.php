<x-app-layout>
    <div class="min-h-screen">
        <div class="flex flex-col justify-center items-center mx-4">
          <h2 class="display-7  my-3">Hello, {{ $user->first }}!</h2>
          <h4 class="my-2 display-8">Welcome to {{ config('app.name') }}, the online ‘meeting place’ where you can connect efficiently with good-fit education opportunities.</h4>
          <div class="text-center">
            <p class="my-2 mx-auto">
              You will now be required to answer a series of questions to create your {{ config('app.name') }} profile. Your answers will determine which universities or programs reach out to you, so please be as thorough and truthful as possible. It will take you about 10 minutes.
            </p>
          </div>
          <a class="mt-6" href="{{ route('student.demographic') }}">
            <x-button><i class="fas fa-play-circle"></i> Let's Begin!</x-button>
          </a>
        </div>
    </div>
</x-app-layout>
