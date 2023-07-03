<x-app-layout>
    <div class="min-h-screen mt-5 mx-2">
        <div class="text-end">
            <a href="{{ route('curriculum.create') }}"><x-button>Add New</x-button></a>
        </div>
        <ul>
            @foreach ($curricula as $curriculum)
                <li><a style="text-decoration: underline" href="{{ route("curriculum.show", ['curriculum' => $curriculum->id]) }}">{{ $curriculum->name }}</a></li>
            @endforeach
        </ul>
    </div>
</x-app-layout>




