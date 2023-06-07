<!--
  | @var StudentUniversity $connection
-->

<x-mail::message>
# Congrats!

Greg will complete this message dear student but let me tell you something, you was approved!!

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
