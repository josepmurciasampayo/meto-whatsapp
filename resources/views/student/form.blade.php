<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('student.handle') }}">
                <input type="hidden" name="page" value="{{ $page() }}">
                @csrf

                @foreach ($questions as $question)
                    <x-question :question="$question"></x-question>
                @endforeach

                <x-button>Submit</x-button>
            </form>
        </div>
    </div>
</x-app-layout>
