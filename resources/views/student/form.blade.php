<x-app-layout>
    <div class="min-h-screen mt-3">
        <x-image-with-text image-src="/img/Meto-background.webp"/>
        <div class="w-full lg:w-3/4 xl:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('student.handle') }}">
                <input type="hidden" name="page" value="{{ $page ?? null }}">
                <input type="hidden" name="curriculum" value="{{ $curriculum ?? null }}">
                <input type="hidden" name="screen" value="{{ $screen ?? null }}">
                <input type="hidden" name="direction" id="direction" value="1">
                @csrf

                @foreach ($questions as $id => $question)
                    <div class="my-3">
                    @php $a = $answers[$id] ?? null @endphp

                    @if (\App\Models\Question::hasResponses($question))
                        <?php $r = isset($responses[$id]) ? $responses[$id] : null ?>
                        <x-question :question="$question" :answer="$a" :responses="$r"></x-question>
                    @else
                        <x-question :question="$question" :answer="$a"></x-question>
                    @endif
                    </div>
                @endforeach

                <x-button-navigation :page="$page" />

            </form>
        </div>
    </div>
</x-app-layout>
