<x-app-layout>
    <h3 class="my-4">Select which curricula to look at</h3>
    <ul>
        @foreach ($curricula as $index => $curriculum)
            <li class="my-1"><a href="{{ route("curriculum", ['curriculum' => $index]) }}">{{ $curriculum }}</a></li>
        @endforeach
    </ul>
</x-app-layout>
