<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <h1 class="display-6 text-center">Sign Up to Get Started <i class="fa fa-sign-in-alt"></i></h1>
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" style="border-top-width: 1px;border-bottom-width: 1px;border-left-width: 1px;margin-right: 1px;margin-top: 10px;border-right-width: 1px;">
            <div class="flex flex-col sm:flex-row sm:-mx-2 mt-6">
                <x-button-nav href="{{ route('signup.student') }}" class="block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 sm:mx-2 px-3 py-2">
                  <i class="fas fa-user-graduate"></i> I'm a student
                </x-button-nav>
                <x-button-nav href="{{ route('signup.uni') }}" class="block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 sm:mx-2 px-3 py-2">
                  <i class="fas fa-university"></i> I work for a university
                </x-button-nav>
                <x-button-nav href="https://meto-intl.typeform.com/signup"
                class="block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 sm:mx-2 px-3 py-2">
                  <i class="fas fa-chalkboard-teacher"></i> I'm a university advisor
                </x-button-nav>
            </div>
        </div>
    </div>
</x-app-layout>





