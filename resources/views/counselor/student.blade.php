<x-app-layout>
    <x-notes-counselor :notes="$notes"></x-notes-counselor>
    <h2 class="my-2">Student Matches - {{ $data[0]['name'] }}</h2>
    <a class="ml-3" href="#raw"><p>Go to raw data</p></a>
    <form id="" method="POST" action="">
    <table id="matches" class="table bg-white mb-5">
        <thead>
            <tr>
                <th>University</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($matches as $match) {?>
                <tr>
                    <td>{{ $match['name'] }}</td>
                    <td>{{ $match['status'] }}</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>

    <h2 id="raw" class="my-2">Student Data - {{ $data[0]['name'] }}</h2>
    <div class="bg-white p-3">
    <?php foreach ($data as $row) { ?>
        <div class="py-3">
            <!-- question ID: <?php echo $row['question_id'] ?> -->
            <x-label value="{{ $row['question'] }}" />
            <p><?php echo $row['answer'] ?></p>
        </div>
    <?php } ?>
    </div>
</x-app-layout>
