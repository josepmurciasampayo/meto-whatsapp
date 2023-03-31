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
        <x-input-text saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-input-text>
    @elseif ($question->format == \App\Enums\QuestionFormat::TEXTAREA())
        <x-textarea saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-textarea>
    @elseif ($question->format == \App\Enums\QuestionFormat::SELECT())
        <x-select saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-select>
    @elseif ($question->format == \App\Enums\QuestionFormat::CHECKBOX())
        @php $answer = explode(',', $answer) @endphp
        <x-checkbox :saved="$answer" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-checkbox>
    @elseif ($question->format == \App\Enums\QuestionFormat::RADIO())
        <x-radio saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-radio>
    @elseif ($question->format === App\Enums\QuestionFormat::DATE())
        <x-date-input name="{!! $question->id !!}" label="{!! $question->text !!}" saved="{!! $answer !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-date-input>
    @elseif ($question->format === App\Enums\QuestionFormat::COUNTRY())
        <x-country-input name="{!! $question->id !!}" label="{!! $question->text !!}" saved="{!! $answer !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-country-input>
    @elseif ($question->format === App\Enums\QuestionFormat::COUNTRY_CHECKBOX())
        <x-country-checkbox name="{!! $question->id !!}" label="{!! $question->text !!}" saved="{!! $answer !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-country-checkbox>
    @elseif ($question->format === App\Enums\QuestionFormat::EMAIL())
        <x-email-input label="{{ $question->text }}" name="email" help="{{ $question->help }}" req="{{ $question->required }}"></x-email-input>
    @elseif ($question->format === App\Enums\QuestionFormat::PHONE())
        <x-phone-input label="{!! $question->text !!}" name="{!! $question->id !!}" saved="{!! $answer !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-phone-input>
    @elseif ($question->format === App\Enums\QuestionFormat::NUMBER())
        <x-inputs.number label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer !!}" req="{{ $question->required }}"></x-inputs.number>
    @elseif ($question->format === App\Enums\QuestionFormat::DOLLAR())
        <x-inputs.dollar label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer !!}" req="{{ $question->required }}"></x-inputs.dollar>
    @elseif ($question->format === App\Enums\QuestionFormat::IBSUBJECT())
        <x-inputs.ib-subjects label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer !!}" req="{{ $question->required }}"></x-inputs.ib-subjects>
    @elseif ($question->format === App\Enums\QuestionFormat::SELECTWITHOTHER())
        <x-inputs.select-other label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer !!}" req="{{ $question->required }}"></x-inputs.select-other>
    @elseif ($question->format === App\Enums\QuestionFormat::GPA())
        <x-inputs.gpa label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer !!}" req="{{ $question->required }}"></x-inputs.gpa>
    @elseif ($question->format === App\Enums\QuestionFormat::AP())
        <x-inputs.ap-subjects label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer !!}" req="{{ $question->required }}"></x-inputs.ap-subjects>
    @elseif ($question->format == \App\Enums\QuestionFormat::LOOKUP())
        <x-inputs.text-lookup label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer !!}" req="{{ $question->required }}"></x-inputs.text-lookup>
    @elseif ($question->format == \App\Enums\QuestionFormat::LETTERGRADE())
        <x-inputs.letter-grades saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.letter-grades>
    @endif
</div>
