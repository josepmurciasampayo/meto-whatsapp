New connection requests from {{ $uni->name }}:
<br /><br />
@foreach($createdConnections as $connection)
    {{ $connection['student']['user']['first'] . ' ' . $connection['student']['user']['last'] }}
@endforeach
<br/><br/>
Please review and approve <a href="{{ route('connections.index') }}">here</a>.
