@props(['question', 'responses' => null])
<div>
    @if ($question->format == \App\Enums\QuestionFormat::INPUT())
        <x-input name="{{ $question->id }}" label="{{ $question->text }}"></x-input>
    @endif
    @if ($question->format == \App\Enums\QuestionFormat::TEXTAREA())
        <x-textarea name="{{ $question->id }}" label="{{ $question->text }}"></x-textarea>
    @endif
    @if ($question->format == \App\Enums\QuestionFormat::SELECT())
        <x-select name="{{ $question->id }}" label="{{ $question->text }}" :options="$responses"></x-select>
    @endif
    @if ($question->format == \App\Enums\QuestionFormat::CHECKBOX())
        <x-checkbox name="{{ $question->id }}" label="{{ $question->text }}" :options="$responses"></x-checkbox>
    @endif
    @if ($question->format == \App\Enums\QuestionFormat::RADIO())
        <x-radio name="{{ $question->id }}" label="{{ $question->text }}" :options="$responses"></x-radio>
    @endif
</div>
