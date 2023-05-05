@props(['question', 'answer', 'responses' => null])
@php
    // responses are sent in a different format for students than admin
    // this converts the student to admin
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
        <x-inputs.text saved="{!! $answer?->text !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" help="{!! $question->help !!}" req="{{ $question->required == 1  }}"></x-inputs.text>
    @elseif ($question->format == \App\Enums\QuestionFormat::TEXTAREA())
        <x-inputs.textarea saved="{!! $answer?->text !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" help="{!! $question->help !!}" req="{{ $question->required == 1 }}"></x-inputs.textarea>
    @elseif ($question->format == \App\Enums\QuestionFormat::SELECT())
        <x-inputs.select saved="{{ $answer?->response_id }}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required == 1 }}"></x-inputs.select>
    @elseif ($question->format == \App\Enums\QuestionFormat::CHECKBOX())
        @php $answer = (is_null($answer)) ? [] : explode(',', $answer->text) @endphp
        <x-inputs.checkbox :saved="$answer" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required == 1 }}"></x-inputs.checkbox>
    @elseif ($question->format == \App\Enums\QuestionFormat::RADIO())
        <x-inputs.radio saved="{{ $answer?->response_id }}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required == 1 }}"></x-inputs.radio>
    @elseif ($question->format === App\Enums\QuestionFormat::DATE())
        <x-inputs.date saved="{!! $answer?->text !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" help="{!! $question->help !!}" req="{{ $question->required == 1 }}"></x-inputs.date>
    @elseif ($question->format === App\Enums\QuestionFormat::COUNTRY_CHECKBOX())
        <x-inputs.country-checkbox name="{!! $question->id !!}" label="{!! $question->text !!}" saved="{!! $answer?->text !!}" help="{!! $question->help !!}" req="{{ $question->required == 1 }}"></x-inputs.country-checkbox>
    @elseif ($question->format === App\Enums\QuestionFormat::EMAIL())
        <x-inputs.email saved="{{ $answer?->text }}" label="{{ $question->text }}" name="{{ $question->id }}" help="{{ $question->help }}" req="{{ $question->required == 1 }}"></x-inputs.email>
    @elseif ($question->format === App\Enums\QuestionFormat::PHONE())
        <x-inputs.phone label="{!! $question->text !!}" name="{!! $question->id !!}" saved="{!! $answer !!}" help="{!! $question->help !!}" req="{{ $question->required == 1 }}"></x-inputs.phone>
    @elseif ($question->format === App\Enums\QuestionFormat::NUMBER())
        <x-inputs.number label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer?->text !!}" req="{{ $question->required == 1 }}"></x-inputs.number>
    @elseif ($question->format === App\Enums\QuestionFormat::SELECTWITHOTHER())
        <x-inputs.select-other label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" :saved="$answer" req="{{ $question->required == 1 }}"></x-inputs.select-other>
    @elseif ($question->format == \App\Enums\QuestionFormat::LOOKUP())
        <x-inputs.lookup-hs label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer?->text !!}" req="{{ $question->required == 1 }}"></x-inputs.lookup-hs>@elseif ($question->format == \App\Enums\QuestionFormat::LOOKUP())
    @elseif ($question->format == \App\Enums\QuestionFormat::LOOKUPORG())
        <x-inputs.lookup-org label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer?->text !!}" req="{{ $question->required == 1 }}"></x-inputs.lookup-org>
    @endif
</div>
