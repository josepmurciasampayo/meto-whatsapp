@props(['question', 'answer', 'responses' => null])
@php
    // responses are sent in a different format for students than admin
    // this converts the first to the second
    if ($responses) {
        $options = array();
        foreach ($responses as $response) {
            $options[$response['id']] = $response['text'];
        }
        $responses = $options;
    }

@endphp
<div>
    @if ($question->format == \App\Enums\QuestionFormat::INPUT())
        <x-input saved="{{ $answer }}" name="{{ $question->id }}" label="{{ $question->text }}" help="{{ $question->help }}"></x-input>
    @endif
    @if ($question->format == \App\Enums\QuestionFormat::TEXTAREA())
        <x-textarea saved="{{ $answer }}" name="{{ $question->id }}" label="{{ $question->text }}" help="{{ $question->help }}"></x-textarea>
    @endif
    @if ($question->format == \App\Enums\QuestionFormat::SELECT())
        <x-select saved="{{ $answer }}" name="{{ $question->id }}" label="{{ $question->text }}" :options="$responses" help="{{ $question->help }}"></x-select>
    @endif
    @if ($question->format == \App\Enums\QuestionFormat::CHECKBOX())
        @php $answer = explode(',', $answer) @endphp
        <x-checkbox :saved="$answer" name="{{ $question->id }}" label="{{ $question->text }}" :options="$responses" help="{{ $question->help }}"></x-checkbox>
    @endif
    @if ($question->format == \App\Enums\QuestionFormat::RADIO())
        <x-radio saved="{{ $answer }}" name="{{ $question->id }}" label="{{ $question->text }}" :options="$responses" help="{{ $question->help }}"></x-radio>
    @endif
</div>
