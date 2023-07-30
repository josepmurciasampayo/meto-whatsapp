<!--
  | @var StudentUniversity $connection
-->

<x-mail::message>
Dear {{ $connection->student->user->first }},

Greetings from {{ config('app.name') }}. {{ $connection->institution->name }} has reviewed your profile and they have determined you are a competitive candidate for admission and would like to invite you to apply.

It is my pleasure to introduce you to {{ $connection->requester->getFullName() }}, the {{ $connection->requester->title }}. To contact {{ $connection->requester->first }}, please email <a href="mailto:{{ $connection->requester->email }}">{{ $connection->requester->email }}</a>.

Here is what you need to know to get started:

Application link:
    <a href="{{ $connection->application_link }}">{{ $connection->application_link }}</a>

Application deadline:{{ \Carbon\Carbon::parse($connection->deadline)->format('m d, Y') }}

Thank you,<br>
{{ config('app.name') }}
</x-mail::message>
