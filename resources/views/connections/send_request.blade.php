New connection requests from {{ count($createdConnections) }} students

<br /><br />

@foreach($createdConnections as $connection)
    @if($loop->first)
        -------------------------------------------------- <br /><br />
    @endif
    <a href="{{ route('counselor-student', ['student_id' => $connection['student']['id']]) }}">Name: {{ $connection['student']['user']['first'] . ' ' . $connection['student']['user']['last'] }}</a>
{{--    <p>Connection Status: {{ \App\Enums\General\MatchStudentInstitution::descriptions()[$connection['status']->value] }}</p>--}}

    @if(! $loop->last)
        -------------------------------------------------- <br /><br />
    @endif
@endforeach
