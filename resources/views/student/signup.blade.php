<x-app-layout>
    @section('title', config('app.name') . ' - Student Sign Up')
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <h1 class="display-7 text-center">Select the statement that best suits your current level <i class="fas fa-level-down-alt"></i></h1>
        <div class="max-w-full lg:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" style="border-top-width: 1px;border-bottom-width: 1px;border-left-width: 1px;margin-right: 1px;margin-top: 10px;border-right-width: 1px;">
            <x-button-nav href="{{ route('student.getStarted') }}" class="block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 sm:mx-2 px-3 py-2">
                <i class="fas fa-user-graduate"></i> I have not begun my university studies
              </x-button-nav>
              <x-button-nav href="{{ route('student.getStarted') }}" class="block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 sm:mx-2 px-3 py-2">
                <i class="fas fa-book-open"></i> I began university studies but have not finished
              </x-button-nav>
              <x-button-nav href="{{ route('student.transfer') }}" class="block text-xl sm:text-2xl lg:text-5xl mb-3 sm:mb-0 sm:w-1/2 lg:w-1/3 sm:mx-2 px-3 py-2">
                <i class="fas fa-exchange-alt"></i> I'm currently in university and looking to transfer
              </x-button-nav>
        </div>
    </div>
</x-app-layout>
