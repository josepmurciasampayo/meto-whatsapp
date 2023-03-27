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
        <x-input-text saved="{{ $answer }}" name="{{ $question->id }}" label="{{ $question->text }}" help="{{ $question->help }}"></x-input-text>
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
    @if ($question->format === App\Enums\QuestionFormat::DATE())
        <x-date-input name="{{ $question->id }}" label="{{ $question->text }}" saved="{{ $answer }}" help="{{ $question->help }}"></x-date-input>
    @endif
    @if ($question->format === App\Enums\QuestionFormat::COUNTRY())
        <x-country-input name="{{ $question->id }}" label="{{ $question->text }}" saved="{{ $answer }}" help="{{ $question->help }}"></x-country-input>
    @endif
    @if ($question->format === App\Enums\QuestionFormat::COUNTRY_CHECKBOX())
        <x-country-checkbox name="{{ $question->id }}" label="{{ $question->text }}" saved="{{ $answer }}" help="{{ $question->help }}"></x-country-checkbox>
    @endif
    @if ($question->format === App\Enums\QuestionFormat::EMAIL())
        <x-email-input label="Email" name="email" help="Enter email address"></x-email-input>
    @endif
    @if ($question->format === App\Enums\QuestionFormat::PHONE())
        <x-phone-input label="{{ $question->text }}" name="{{ $question->id }}" saved="{{ $answer }}" help="{{ $question->help }}"></x-phone-input>
    @endif
    @if ($question->format === App\Enums\QuestionFormat::COUNTRY())
        <x-country-input name="{{ $question->id }}" label="{{ $question->text }}" saved="{{ $answer }}" help="{{ $question->help }}" />
    @endif
    @if ($question->format === App\Enums\QuestionFormat::COUNTRY_CHECKBOX())
        <x-country-checkbox name="{{ $question->id }}" label="{{ $question->text }}" saved="{{ $answer }}" help="{{ $question->help }}" />
    @endif
    @if ($question->format === App\Enums\QuestionFormat::EMAIL())
        <x-email-input label="{{ $question->text }}" name="{{ $question->id }}" saved="{{ $answer }}" help="{{ $question->help }}"></x-email-input>
    @endif
    @if ($question->format === App\Enums\QuestionFormat::PHONE())
        <x-phone-input label="{{ $question->text }}" name="{{ $question->id }}" saved="{{ $answer }}" help="{{ $question->help }}"/>
    @endif
    @if ($question->format === App\Enums\QuestionFormat::HIGHSCHOOL())
        <x-high_school_search label="{{ $question->text }}" name="{{ $question->id }}" help="{{ $question->help }}" saved="{{ $answer }}"/>
    @endif
    @if ($question->format === App\Enums\QuestionFormat::NUMBER())
        <x-number-input label="{{ $question->text }}" name="{{ $question->id }}" help="{{ $question->help }}" saved="{{ $answer }}"/>
    @endif
    @if ($question->format === App\Enums\QuestionFormat::DOLLAR())
        <x-cash-value-input  label="{{ $question->text }}" name="{{ $question->id }}" help="{{ $question->help }}" saved="{{ $answer }}"/>
    @endif
</div>
