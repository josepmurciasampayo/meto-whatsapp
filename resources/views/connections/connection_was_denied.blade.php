<!--
 | @var $studentUniversity
-->

<x-mail::message>
Dear {{ $studentUniversity->requester->first }},

    We wanted to let you know that one of your connection requests was denied.

We are unable to provide more detailed information on email but you can get in touch with any questions.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
