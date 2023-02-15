<x-app-layout>




    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
               <x-image-with-text
                                  image-src="/img/Meto-background.webp"
                                  alt=""
                                  text="Student | Get Started"/>

        <div class="w-75 lg:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

            
            <form method="POST" action="{{ route('student.handle') }}">
                <input type="hidden" name="page" value="{{ \App\Enums\Page::GETSTARTED() }}">
                @csrf
                <x-input name="first" label="First/Given Name"></x-input>
                <x-input name="last" label="Last/Family Name"></x-input>
                <x-input name="middle" label="Middle Name"></x-input>
                <x-input name="country" label="Country"></x-input>
                <x-input name="gender" label="Gender"></x-input>
                <x-input name="email" label="Email Address"></x-input>
                <x-input name="password" label="Password"></x-input>

                <div class="text-center my-4">
                    <div class="flex justify-center items-center">
                      <x-button type="submit">Next <i class="fa fa-chevron-right"></i></x-button>
                    </div>
                  </div>
                  
            </form>

            <div class="flex align-items-center justify-center mt-20 text-sm">
                <p>Already have a Meto account?</p>
                <span class="mx-2"></span>
                <x-button-nav href="{{route('login') }}" class="btn btn-outline text-gray-600 hover:text-gray-900 text-xs text-center w-10"><i class="fa fa-sign-in"></i> Log In</x-button-nav>
            </div>
        </div>
    </div>
</x-app-layout>


