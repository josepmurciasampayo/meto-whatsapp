<x-app-layout>
    <div class="min-h-screen mt-5 mx-2 w-full">
        @php $curriculum = \App\Enums\Student\Curriculum::descriptions() @endphp
        @php $scoreType = \App\Enums\ScoreType::descriptions() @endphp

        <div class="table-container mb-5" style="height: 100vh; overflow-y: scroll;">
            <table id="dataTable" class="table table-striped bg-white">
                <thead>
                <tr class="text-center">
                    <th>Curriculum</th>
                    <th>Score Type</th>
                    <th>Score</th>
                    <th>Percentile</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($equivalencies as $e)
                    <tr class="text-center">
                        <td>{{ $curriculum[$e->curriculum_id] }}</td>
                        <td>{{ $scoreType[$e->score_type] }}</td>
                        <td>{{ $e->score }}</td>
                        <td>{{ $e->percentile }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <x-dataTable></x-dataTable>
        </div>
    </div>
</x-app-layout>
