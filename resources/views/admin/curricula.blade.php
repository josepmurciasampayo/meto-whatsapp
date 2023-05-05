<x-app-layout>
    <div class="min-h-screen mt-5 mx-2">
    <h3 class="my-4">Select which curricula to look at</h3>
    <ul>
        @php $curriculumList = array_values($curricula); @endphp
        @foreach ($curriculumList as $curriculum)
            <li><a href="{{ route("curriculum", ['curriculum' => array_search($curriculum, $curricula)]) }}">{{ $curriculum }}</a></li>
        @endforeach
    </ul>
    
</x-app-layout>




