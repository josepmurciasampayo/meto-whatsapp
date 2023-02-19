
<x-app-layout>
    <div class="min-h-screen">
        <div class="flex flex-col justify-center items-center flex-grow">
          <h2 class="display-6  mb-3">Welcome Abraham!</h2>
          <h4 class="my-2">Welcome to Meto, the online ‘meeting place’ where you can connect efficiently with good-fit education opportunities.</h4>
          <div class="text-center">
            <p class="my-2 w-75 mx-auto">
              You will now be required to answer a series of questions to create your Meto profile. Your answers will determine which universities or programs reach out to you, so please be as thorough and truthful as possible. It will take you 15 minutes.
            </p>
          </div>
          <a class="mt-6" href="{{ route('student.profile') }}">
            <x-button><i class="fas fa-play-circle"></i> Let's Begin!</x-button>
          </a>
        </div>
     
      

</x-app-layout>
