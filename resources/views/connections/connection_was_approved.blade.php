<!--
  | @var StudentUniversity $studentUniversity
-->

<x-mail::message>
Dear {{ $studentUniversity->student->user->first }},

Greetings from {{ config('app.name') }}. {{ $studentUniversity->institution->name }} has reviewed your profile and they have determined you are a competitive candidate for admission and would like to invite you to apply.

It is my pleasure to introduce you to {{ $studentUniversity->requester->getFullName() }}, the {{ $studentUniversity->requester->title }}. To contact {{ $studentUniversity->requester->first }}, please email <a href="mailto:{{ $studentUniversity->requester->email }}">{{ $studentUniversity->requester->email }}</a>.

Here is what you need to know to get started.

Application link:
    <a href="{{ $studentUniversity->application_link }}">{{ $studentUniversity->application_link }}</a>

Application deadline: {{ \Carbon\Carbon::parse($studentUniversity->deadline)->format('M d, Y') }}

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
