
<x-app-layout>

  <x-popup-redirect
    title="Update Your Academic & Financial Information"
    text="Please update your information to ensure that your records are up-to-date and you can get the best result from Meto."
    btn_text="Update Now"
    btn_href="/academics"
    btn_icon="fa fa-arrow-right"
/>




  
    <div class="min-h-screen">
        <div class="flex flex-col justify-center items-center">
          <h2 class="display-7  mb-3">Hello, Abraham!</h2>
          <h4 class="my-2 display-8">Welcome to Meto, the online ‘meeting place’ where you can connect efficiently with good-fit education opportunities.</h4>
          <div class="text-center">
            <p class="my-2 mx-auto">
              You will now be required to answer a series of questions to create your Meto profile. Your answers will determine which universities or programs reach out to you, so please be as thorough and truthful as possible. It will take you about 30 minutes.
            </p>
          </div>
          <a class="mt-6" href="{{ route('student.profile') }}">
            <x-button><i class="fas fa-play-circle"></i> Let's Begin!</x-button>
          </a>
        </div>
     
      

</x-app-layout>
