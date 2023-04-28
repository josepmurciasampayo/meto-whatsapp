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
        <x-inputs.text saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.text>
    @elseif ($question->format == \App\Enums\QuestionFormat::TEXTAREA())
        <x-inputs.textarea saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.textarea>
    @elseif ($question->format == \App\Enums\QuestionFormat::SELECT())
        <x-inputs.select saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.select>
    @elseif ($question->format == \App\Enums\QuestionFormat::CHECKBOX())
        @php $answer = (is_null($answer)) ? [] : explode(',', $answer) @endphp
        <x-inputs.checkbox :saved="$answer" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.checkbox>
    @elseif ($question->format == \App\Enums\QuestionFormat::RADIO())
        <x-inputs.radio saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.radio>
    @elseif ($question->format === App\Enums\QuestionFormat::DATE())
        <x-inputs.date name="{!! $question->id !!}" label="{!! $question->text !!}" saved="{!! $answer !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.date>
    @elseif ($question->format === App\Enums\QuestionFormat::COUNTRY())
        <x-inputs.country name="{!! $question->id !!}" label="{!! $question->text !!}" saved="{!! $answer !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.country>
    @elseif ($question->format === App\Enums\QuestionFormat::COUNTRY_CHECKBOX())
        <x-inputs.country-checkbox name="{!! $question->id !!}" label="{!! $question->text !!}" saved="{!! $answer !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.country-checkbox>
    @elseif ($question->format === App\Enums\QuestionFormat::EMAIL())
        <x-inputs.email label="{{ $question->text }}" name="{{ $question->id }}" help="{{ $question->help }}" req="{{ $question->required }}" saved="{{ $answer }}"></x-inputs.email>
    @elseif ($question->format === App\Enums\QuestionFormat::PHONE())
        <x-inputs.phone label="{!! $question->text !!}" name="{!! $question->id !!}" saved="{!! $answer !!}" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.phone>
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
        <x-inputs.lookup-hs label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer !!}" req="{{ $question->required }}"></x-inputs.lookup-hs>@elseif ($question->format == \App\Enums\QuestionFormat::LOOKUP())
    @elseif ($question->format == \App\Enums\QuestionFormat::LOOKUPORG())
        <x-inputs.lookup-org label="{!! $question->text !!}" name="{!! $question->id !!}" help="{!! $question->help !!}" saved="{!! $answer !!}" req="{{ $question->required }}"></x-inputs.lookup-org>
    @elseif ($question->format == \App\Enums\QuestionFormat::LETTERGRADE())
        <x-inputs.letter-grades saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.letter-grades>
    @elseif ($question->format == \App\Enums\QuestionFormat::CAMSUBJECT())
        <x-inputs.cambridge-subject saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.cambridge-subject>
    @elseif ($question->format == \App\Enums\QuestionFormat::IGCSEGRADE())
        <x-inputs.igcse-grades saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.igcse-grades>
    @elseif ($question->format == \App\Enums\QuestionFormat::ALEVEL())
        <x-inputs.alevel-subjects saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.alevel-subjects>
    @elseif ($question->format == \App\Enums\QuestionFormat::ALEVELGRADE())
        <x-inputs.alevel-grades saved="{!! $answer !!}" name="{!! $question->id !!}" label="{!! $question->text !!}" :options="$responses" help="{!! $question->help !!}" req="{{ $question->required }}"></x-inputs.alevel-grades>
    @endif
</div>
