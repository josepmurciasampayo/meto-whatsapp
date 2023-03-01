<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-2 sm:pt-0">
        <x-image-with-text
                           image-src="/img/Meto-background.webp"/>

 <div class="w-75 lg:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('student.handle') }}">
                <input type="hidden" name="page" value="{{ $page() }}">
                @csrf

                @foreach ($questions as $question)
                    @if ($question->hasResponses())
                        <x-question :question="$question" :responses="$responses[$question->id]"></x-question>
                    @else
                        <x-question :question="$question"></x-question>
                    @endif
                @endforeach

                


            </form>
        </div>
    </div>
</x-app-layout>
