@props(['question'])
<div>
@if ($question->format == \App\Enums\QuestionFormat::INPUT())
    <x-input></x-input>
@endif
@if ($question->format == \App\Enums\QuestionFormat::SELECT())
    <x-select></x-select>
@endif
@if ($question->format == \App\Enums\QuestionFormat::RADIO())
    <x-textarea></x-textarea>
@endif
@if ($question->format == \App\Enums\QuestionFormat::CHECKBOX())
    <x-checkbox></x-checkbox>
@endif
</div>
