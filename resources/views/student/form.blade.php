<x-app-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-2 sm:pt-0">
        <x-image-with-text image-src="/img/Meto-background.webp"/>
        <div class="w-full lg:w-3/4 xl:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('student.handle') }}">
                <input type="hidden" name="page" value="{{ $page ?? null }}">
                <input type="hidden" name="curriculum" value="{{ $curriculum ?? null }}">
                <input type="hidden" name="screen" value="{{ $screen }}">
                @csrf

                @foreach ($questions as $question)
                    <div class="my-3">
                    <?php $a = isset($answers[$question->id]) ? $answers[$question->id] : null ?>
                    @if ($question->hasResponses())
                        <?php $r = isset($responses[$question->id]) ? $responses[$question->id] : null ?>
                        <x-question :question="$question" :answer="$a" :responses="$r"></x-question>
                    @else
                        <x-question :question="$question" :answer="$a"></x-question>
                    @endif
                    </div>
                @endforeach

            <x-button-navigation/>

            </form>
        </div>
    </div>
</x-app-layout>
