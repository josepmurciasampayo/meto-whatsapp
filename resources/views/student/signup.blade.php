<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <a href="{{ route('student.getStarted') }}"><x-button class="w-full">I have not begun my university studies</x-button></a>
            <a href="{{ route('student.getStarted') }}"><x-button class="w-full mt-3">I began university studies but have not finished</x-button></a>
            <a href="{{ route('student.transfer') }}"><x-button class="w-full mt-3">I'm currently in university and looking to transfer</x-button></a>
        </div>
    </div>
</x-app-layout>