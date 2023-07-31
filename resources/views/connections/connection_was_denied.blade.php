<!--
 | @var $studentUniversity
-->

<x-mail::message>
Dear {{ $studentUniversity->student->user->first }},

We wanted to let you know that we denied your connection request for:
    {{ $studentUniversity->student->user->getFullName() }}

We are unable to provide more detailed information on email but you can get in touch with any questions.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
