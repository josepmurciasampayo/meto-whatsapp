<x-app-layout>
    <h3>Select which curricula to look at</h3>
    <ul>
        @foreach ($curricula as $index => $curriculum)
            <li><a href="{{ route("curriculum", ['curriculum' => $index]) }}">{{ $curriculum }}</a></li>
        @endforeach
    </ul>
</x-app-layout>
